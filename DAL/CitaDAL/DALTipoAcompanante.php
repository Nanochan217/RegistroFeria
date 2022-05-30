<?php

    class DALTipoAcompanante
    {
        function BuscarTodos()
        {
            $tiposDB = array();
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion();

            $consultaSql = "SELECT * FROM `TIPOACOMPANANTE`";

            $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

            if (mysqli_num_rows($respuestaDB) > 0)
            {
                while ($filasColegios = $respuestaDB->fetch_assoc())
                {
                    $tiposAcompanante = new TipoAcompanante();
                    $tiposAcompanante->setId($filasColegios["id"]);
                    $tiposAcompanante->setTipoAcompanante($filasColegios["tipoAcompanante"]);
                    $tiposAcompanante->setActive($filasColegios["active"]);

                    $tiposDB[] = $this->dismount($tiposAcompanante);
                }
            }
            else
            {
                $tiposDB = null;
            }

            $conexionDB->CerrarConexion();
            return $tiposDB;
        }

        function dismount($object)
        {
            $reflectionClass = new ReflectionClass(get_class($object));
            $array = array();
            foreach ($reflectionClass->getProperties() as $property)
            {
                $property->setAccessible(true);
                $array[$property->getName()] = $property->getValue($object);
                $property->setAccessible(false);
            }
            return $array;
        }
    }