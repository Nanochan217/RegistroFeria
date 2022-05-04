<?php
    class DALPerfiles
    {
        function BuscarTodosPerfiles()
        {
            $perfilesDB = array();
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `PERFIL` WHERE `ACTIVE` = 1";

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filasPerfil = $respuestaDB->fetch_assoc())
                {
                    $perfil = new Perfil();
                    $perfil->setId($filasPerfil["id"]);
                    $perfil->setNombrePerfil($filasPerfil["correo"]);
                    $perfil->setDescripcion($filasPerfil["contrasena"]);
                    $perfil->setActive($filasPerfil['active']);
                    $perfilesDB[]=$perfil;
                }
            }
            else
            {
                $perfilesDB = null;
            }

            $conexionDB->CerrarConexion();
            return $perfilesDB;
        }
    }
