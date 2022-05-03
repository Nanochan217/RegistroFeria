<?php
    class DALLogIn
    {
        function NuevaSesionUsuario(Credenciales $credencialesSesion)
        {
            $credencial = new Credenciales();
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM 'CREDENCIALES' WHERE 'CORREO'='".$credencialesSesion->getCorreo()."' 
                            && 'CONTRASENA'='".$credencialesSesion->getContrasena()."' && 'ACTIVE' = 1";
            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while ($filaCredencial = $respuestaDB->fetch_assoc())
                {
                    $credencial->setId($filaCredencial['ID']);
                    $credencial->setCorreo($filaCredencial['CORREO']);
                    $credencial->setContrasena($filaCredencial['CONTRASENA']);
                    $credencial->setActive($filaCredencial['ACTIVE']);
                }
            }
            else
            {
                $credencial = null;
            }

            $conexionDB->CerrarConexion();
            return $credencial;
        }

        function RestablecerContrasena()
        {
            //PENDIENTE
        }
    }
