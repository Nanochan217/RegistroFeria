<?php
    class DALLogIn
    {
        function BuscarHashContrasena(Credenciales $credencial)
        {        
            $conexionDB = new Conexion();
            
            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `CORREO` = '".$credencial->getCorreo()."' AND `ACTIVE` = 1";            
            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);
            
            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaCredencial = $respuestaDB->fetch_assoc())
                {
                    $credencial->setId($filaCredencial["id"]);
                    $credencial->setContrasena($filaCredencial["contrasena"]);
                }            
            }
            else
            {
                $credencial = null;
            }       
            
            $conexionDB->CerrarConexion();
            return $credencial;
        }
        
        function NuevaSesionUsuario(Credenciales $credencialesSesion)
        {
            $nuevasCredenciales = new Credenciales();
            
            $nuevasCredenciales = $this->BuscarHashContrasena($credencialesSesion);            
                        
            if(!password_verify($credencialesSesion->getContrasena(), $nuevasCredenciales->getContrasena()))
            {
                
            return $credencialesSesion;
            }         
            
        }

        function VerificarCorreoUsuario($correoUsuario)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `CORREO` ='".$correoUsuario."' AND `ACTIVE`= 1";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $token = md5($correoUsuario).rand(10, 9999);
                $link = "../../GUI/PasswordRecovery.php?key=".$correoUsuario."&token=".$token;//Link generado
                $tituloCorreo = "Solicitud de Restablecimiento de Contraseña";
                $cuerpoCorreo = "¡Hemos recibido una solicitud de cambio de contraseña! Haz click en el siguiente enlace para restablecer tu contraseña: '".$link."'";                
                $cuerpoCorreo = wordwrap($cuerpoCorreo, 70);
                
                //La función "Envía el Correo" pero el servidor de SMTP no lo realiza y por ende el receptor no lo recibe...
                if(mail($correoUsuario, $tituloCorreo, $cuerpoCorreo))
                {
                    $resultado = true;
                }
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        //HACER EL ENCRIPTADO DE LA CONTRASEÑA!!!!!!!!!!
        function RestablecerContrasena($correoUsuario, $nuevaContraseña)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "UPDATE `CREDENCIALES` SET `CONTRASENA`=".$nuevaContraseña." WHERE `CORREO`=".$correoUsuario;

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