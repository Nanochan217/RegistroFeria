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
                    $perfil->setNombrePerfil($filasPerfil["nombrePerfil"]);
                    $perfil->setDescripcion($filasPerfil["descripcion"]);
                    $perfil->setActive($filasPerfil['active']);
                    $perfilesDB[]= $this->dismount( $perfil);
                }
            }
            else
            {
                $perfilesDB = null;
            }

            $conexionDB->CerrarConexion();
            return $perfilesDB;
        }
        function dismount($object)
        {
            $reflectionClass = new ReflectionClass(get_class($object));
            $array = array();
            foreach ($reflectionClass->getProperties() as $property) {
                $property->setAccessible(true);
                $array[$property->getName()] = $property->getValue($object);
                $property->setAccessible(false);
            }
            return $array;
        }  
    }
