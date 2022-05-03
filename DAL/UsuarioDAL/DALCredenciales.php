<?php
    class DALCredenciales
    {
        function NuevaCredencial(Credenciales $nuevaCredencial)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "INSERT INTO 'CREDENCIALES'('CORREO', 'CONTRASENA', 'ACTIVE') 
                    VALUES ('".$nuevaCredencial->getCorreo()."','".$nuevaCredencial->getContrasena()."', 1)";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }
            $conexionDB->CerrarConexion();
            return $resultado;
        }

        //Método para buscar la ultima credencial creada y devolverla al BL
        function UltimaCredencial()
        {
            $ultimaCredencial = new Credenciales();
            $conexionDB = new Conexion();
            $consultaSql = "SELECT * FROM 'CREDENCIALES' WHERE 'ID'=(SELECT MAX('ID') FROM 'CREDENCIALES') AND 'ACTIVE' = 1;";
            $credencial = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($credencial)>0)
            {
                while($filaCredencial = $credencial->fetch_assoc())
                {
                    $ultimaCredencial->setId($filaCredencial["ID"]);
                    $ultimaCredencial->setCorreo($filaCredencial["CORREO"]);
                    $ultimaCredencial->setContrasena($filaCredencial["CONTRASENA"]);
                    $ultimaCredencial->setActive($filaCredencial["ACTIVE"]);
                }
            }
            else
            {
                $ultimaCredencial = null;
            }
            $conexionDB->CerrarConexion();
            return $ultimaCredencial;
        }

        function ActualizarCredenciales(Credenciales $modificarCredenciales)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $consultaSql = "UPDATE 'CREDENCIALES' SET 'CORREO'='".$modificarCredenciales->getCorreo()."' 
                            SET 'CONTRASENA'='".$modificarCredenciales->getContrasena()."' WHERE 'ID'=".$modificarCredenciales->getId();

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }
            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function BuscarTodasCredenciales()
        {
            $credencialesDB = array();
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM 'CREDENCIALES' WHERE 'ACTIVE' = 1";

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filasCredencial = $respuestaDB->fetch_assoc())
                {
                    $credencial = new Credenciales();
                    $credencial->setId($filasCredencial["ID"]);
                    $credencial->setCorreo($filasCredencial["CORREO"]);
                    $credencial->setContrasena($filasCredencial["CONTRASENA"]);
                    $credencial->setActive($filasCredencial['ACTIVE']);
                    $credencialesDB[]=$credencial;
                }
            }
            else
            {
                $credencialesDB = null;
            }
            $conexionDB->CerrarConexion();
            return $credencialesDB;
        }

        function BuscarIdCredencial($idUsuario)
        {
            $credencialesDB = new Credenciales();
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM 'CREDENCIALES' WHERE 'ID' = '$idUsuario'";

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaUsuario = $respuestaDB->fetch_assoc())
                {
                    $credencialesDB->setId($filaUsuario["ID"]);
                    $credencialesDB->setCorreo($filaUsuario["CORREO"]);
                    $credencialesDB->setContrasena($filaUsuario["CONTRASENA"]);
                    $credencialesDB->setActive($filaUsuario["ACTIVE"]);
                }
            }
            else
            {
                $credencialesDB = null;
            }

            $conexionDB->CerrarConexion();
            return $credencialesDB;
        }

        function DesactivarCredencial(Credenciales $desactivarCredencial)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "SELECT FROM 'CREDENCIALES' WHERE 'ID'= '".$desactivarCredencial->getId()."' SET 'ACTIVE' =".$desactivarCredencial->getActive();

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }
            $conexionDB->CerrarConexion();
            return $resultado;
        }
    }