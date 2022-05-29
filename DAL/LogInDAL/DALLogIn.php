<?php
    class DALLogIn
    {
        function NuevaSesionUsuario(Credenciales $credencialesSesion)
        {
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $correoUsuario = $credencialesSesion->getCorreo();
            $contrasenaUsuario = $credencialesSesion->getContrasena();            
            
            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `CORREO` = '" . $correoUsuario . "' AND `ACTIVE` = 1";
            
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

        function NuevaSolicitudContrasena(Solicitudes $nuevaSolicitud)
        {   
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();            

            $consultaSql = "INSERT INTO `SOLICITUDNUEVACONTRASENA` (`FECHASOLICITUD`, `FECHAEXPIRACION`, `CODIGOSOLICITUD`)
            VALUES ('" . $nuevaSolicitud->getFechaSolicitud() . "', '" . $nuevaSolicitud->getFechaExpiracion() . "', '" . $nuevaSolicitud->getCodigoSolicitud() . "')";
                        
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
            date_default_timezone_set("America/Costa_Rica");
            $fechaConsulta = strtotime(date("d-m-y H:i:s",time()));            
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            if(isset($codigoSolicitud))
            {
                $consultaSql = "SELECT * FROM `SOLICITUDNUEVACONTRASENA` WHERE `CODIGOSOLICITUD` = '" . $codigoSolicitud . "' AND `ACTIVE` = 1";
            }
            else if(isset($correo))
            {
                $consultaSql = "SELECT * FROM `SOLICITUDNUEVACONTRASENA` WHERE `CORREOUSUARIO` = '" . $correo . "' AND `ACTIVE` = 1";
            }
            
            $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaSolicitud = $respuestaDB->fetch_assoc())
                {                    
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

            $consultaSql = "UPDATE `CREDENCIALES` SET `CONTRASENA`='" . $contrasenaEncriptada . "' WHERE `CORREO`=" . $correoUsuario;

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
                $consultaSql = "UPDATE `SOLICITUDNUEVACONTRASENA` SET `ACTIVE` = 0 WHERE `CODIGOSOLICITUD` = '" . $codigoSolicitud . "'";
            }
            else if(isset($correo))
            {
                $consultaSql = "UPDATE `SOLICITUDNUEVACONTRASENA` SET `ACTIVE` = 0 WHERE `CORREOUSUARIO` = '" . $correo . "'";
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