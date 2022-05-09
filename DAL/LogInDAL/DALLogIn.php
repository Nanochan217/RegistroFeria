<?php
    class DALLogIn
    {
        function NuevaSesionUsuario(Credenciales $credencialesSesion)
        {
            //$credencial = new Credenciales();
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `CORREO` ='".$credencialesSesion->getCorreo()."' 
                            AND `CONTRASENA` ='".$credencialesSesion->getContrasena()."' AND `ACTIVE` = 1";
            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while ($filaCredencial = $respuestaDB->fetch_assoc())
                {
                    $credencialesSesion->setId($filaCredencial["id"]);
                }
            }
            else
            {
                $credencialesSesion = null;
            }

            $conexionDB->CerrarConexion();
            return $credencialesSesion;
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

                if(imap_mail($correoUsuario, $tituloCorreo, $cuerpoCorreo))
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

            $consultaSql = "SELECT * FROM `CREDENCIALES` SET `CONTRASENA`=".$nuevaContraseña." WHERE `CORREO`=".$correoUsuario;

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }
    }

//En caso de añadir un tiempo de expiración...
//$expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("y"));
//$expDate = date("Y-m-d H:i:s", $expFormat);
//$update = "";