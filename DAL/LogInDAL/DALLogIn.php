<?php
    class DALLogIn
    {
        function NuevaSesionUsuario(Credenciales $credencialesSesion)
        {
            $conexionDB = new Conexion();
            $correoUsuario = $credencialesSesion->getCorreo();
            $contrasenaUsuario = $credencialesSesion->getContrasena();            
            
            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `CORREO` = '".$correoUsuario."' AND `ACTIVE` = 1";
            
            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);
            
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
        function VerificarCorreoUsuario($correoUsuario)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `CORREO` ='".$correoUsuario."' AND `ACTIVE`= 1";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $token = md5($correoUsuario).rand(10, 9999); 
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
        
        function RestablecerContrasena($correoUsuario, $nuevaContraseña)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $contrasenaEncriptada = password_hash($nuevaContraseña, PASSWORD_DEFAULT);

            $consultaSql = "UPDATE `CREDENCIALES` SET `CONTRASENA`=".$contrasenaEncriptada." WHERE `CORREO`=".$correoUsuario;

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }
    }

//En caso de añadir un tiempo de expiración al Correo Electrónico de Recuperación de Conttraseña...
//$expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("y"));
//$expDate = date("Y-m-d H:i:s", $expFormat);
//$update = "";

///////////////////////////////////////////////////////////////////////////////////////////