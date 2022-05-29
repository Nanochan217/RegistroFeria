<?php
    class DALLogIn
    {
        function NuevaSesionUsuario(Credenciales $credencialesSesion)
        {
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $correoUsuario = $credencialesSesion->getCorreo();
            $contrasenaUsuario = $credencialesSesion->getContrasena();            
            
            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `CORREO` = '".$correoUsuario."' AND `ACTIVE` = 1";
            
            $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);
            
            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaCredencial = $respuestaDB->fetch_assoc())
                {
                    //verifica la contraseña del Log In con el Hash (contraseña encriptada)
                    if(password_verify($contrasenaUsuario, $filaCredencial["contrasena"]))
                    {                                                          
                        $credencialesSesion->setId($filaCredencial["id"]);
                    }
                    else
                    {
                        $credencialesSesion = null;
                    }
                }
            }
            else
            {
                $credencialesSesion = null;
            }
            
            $conexionDB->CerrarConexion();
            return $credencialesSesion;                        
        }

        //En proceso...
        //VALORAR CAMBIAR EL FLUJO DE EJECUCION EN CUYO CASO
        //SE DEBERA PRIMERO AÑADIR LA SOLICITUD (GENERAR UN STRING ALEAT.) 
        //Y DESPUES CONSULTAR DICHA TABLA EN LA VERIFICACION DE CORREO
        //EXTRAER ESOS DATOS Y CONCATENARLOS EN EL HTML...
        function CorreoRestablecerContrasena(Solicitudes $solitudCambioContrasena)
        {
            $correoUsuario = $solitudCambioContrasena->getCodigoSolicitud();            
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `CORREO` ='".$correoUsuario."' AND `ACTIVE`= 1";

            if($conexionDB->NuevaConsulta($consultaSql))
            {            
                //ADJUNTAR AL LINK COMO VARIABLE DE PHP (?cod=$hashSolicitud)!!
                $hashSolicitud = crypt($correoUsuario, 'rl');
                
                //PASAR EL CORREO Y EL CODIGO (PA FACILITAR XD)
                //USAR: $solitudCambioContrasena->getFechaSolicitud()
                //USAR: $solitudCambioContrasena->getFechaExpiracion()
                //ESTO PARA INDICARLE EN EL CORREO A LA PERSONA QUE LA SOLICITUD
                //FUE EL DIA X Y HORA X y QUE TIENE TIEMPO 30MINS PARA RESTABLECERLA
                //E INDICARLE QUE EXPIRA EL DIA X Y HORA X

                $to = $correoUsuario;               
                $tituloCorreo = "Solicitud de Restablecimiento de Contraseña";
                $html = "<html><head><title>Document</title></head><body><h1 style='background-color: red;'>Hola q tal</h1></body></html>";
                $cuerpoCorreo = $html;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <feriavocacionalcovao@gmail.com>' . "\r\n";                
                
                if (mail($to, $tituloCorreo, $cuerpoCorreo, $headers))
                {                    
                    $resultado = true;                    
                }                
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }
        
        function NuevaSolicitudContrasena(Solicitudes $nuevaSolicitud)
        {   
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $codigoNuevaSolicitud = $nuevaSolicitud->getCodigoSolicitud();
                        
            $hashSolicitud = crypt($codigoNuevaSolicitud, 'rl');                        

            $consultaSql = "INSERT INTO `SOLICITUDNUEVACONTRASENA` (`FECHASOLICITUD`, `FECHAEXPIRACION`, `CODIGOSOLICITUD`, `ACTIVE`)
                VALUES ('".$nuevaSolicitud->getFechaSolicitud()."', '".$nuevaSolicitud->getFechaExpiracion()."', '".$hashSolicitud."', 1)";
                        
            if($conexionDB->NuevaConsulta($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        //Parametro obtenido por GET en el BL de Nueva Contraseña
        function BuscarSolicitudContrasena($codigoSolicitud, $correo)
        {
            $solicitudUsuario = "";
            $fechaConsulta = strtotime(date("d-m-y H:i:s",time()));            
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            if(isset($codigoSolicitud))
            {
                $consultaSql = "SELECT * FROM `SOLICITUDNUEVACONTRASENA` WHERE `CODIGOSOLICITUD` = '".$codigoSolicitud."' AND `ACTIVE` = 1";
            }
            else if(isset($correo))
            {
                $consultaSql = "SELECT * FROM `SOLICITUDNUEVACONTRASENA` WHERE `CORREOUSUARIO` = '".$correo."' AND `ACTIVE` = 1";
            }
            
            $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaSolicitud = $respuestaDB->fetch_assoc())
                {
                    //OJO
                    if($fechaConsulta <= strtotime($filaSolicitud["fechaExpiracion"]))
                    {
                        if(password_verify($codigoSolicitud, $filaSolicitud["codigoSolicitud"]))
                        {                            
                            $solicitudUsuario = $filaSolicitud["correoUsuario"];
                        }
                        else
                        {
                            $solicitudUsuario = "Denegado";
                        }
                    }
                    else
                    {
                        $solicitudUsuario = "Expirado";
                    }
                }
            }

            $conexionDB->CerrarConexion();
            return $solicitudUsuario;
        }

        function RestablecerContrasena($correoUsuario, $nuevaContraseña)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $contrasenaEncriptada = password_hash($nuevaContraseña, PASSWORD_DEFAULT);

            $consultaSql = "UPDATE `CREDENCIALES` SET `CONTRASENA`=".$contrasenaEncriptada." WHERE `CORREO`=".$correoUsuario;

            if($conexionDB->NuevaConsulta($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function DesactivarSolicitud($codigoSolicitud, $correo)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            if(isset($codigoSolicitud))
            {
                $consultaSql = "UPDATE `SOLICITUDNUEVACONTRASENA` SET `ACTIVE` = 0 WHERE `CODIGOSOLICITUD` = '".$codigoSolicitud."'";
            }
            else if(isset($correo))
            {
                $consultaSql = "UPDATE `SOLICITUDNUEVACONTRASENA` SET `ACTIVE` = 0 WHERE `CORREOUSUARIO` = '".$correo."'";
            }            

            if($conexionDB->NuevaConsulta($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////