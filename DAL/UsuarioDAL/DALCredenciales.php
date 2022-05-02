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
            $consultaSql = "SELECT * FROM 'CREDENCIALES' WHERE 'id'=(SELECT MAX('id') FROM 'CREDENCIALES') AND 'ACTIVE' = 1;";
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
            //MODIFICAR CREDENCIALES DEL USUARIO
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "QUERY";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }
            $conexionDB->CerrarConexion();
            return $resultado;
        }
    }