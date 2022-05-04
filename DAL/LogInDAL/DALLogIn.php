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

        //PENDIENTE REVISAR IF DEL CORREO TRAS LA CONSULTA SQL!!!
        function VerificarCorreoUsuario($correoUsuario)
        {
            $resultado = false;
            $correoID = $correoUsuario;
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `CORREO` ='".$correoID."' AND `ACTIVE`= 1";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $token = md5($correoID).rand(10, 9999);

                //En caso de añadir un tiempo de expiración...
                //$expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("y"));
                //$expDate = date("Y-m-d H:i:s", $expFormat);
                //$update = "";

                $link = "../../GUI/PasswordRecovery.php?key=".$correoID."&token=".$token;//Link generado
                $tituloCorreo = "Solicitud de Restablecimiento de Contraseña";
                $cuerpoCorreo = "¡Hemos recibido una solicitud de cambio de contraseña! Haz click en el siguiente enlace para restablecer tu contraseña: '".$link."'";                
                $cuerpoCorreo = wordwrap($cuerpoCorreo, 100, "\n");
                if(mail($correoID, $tituloCorreo, $cuerpoCorreo))
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