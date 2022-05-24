<?php

class DALColegioProcedencia
{
    function BuscarIdColegio()
    {
        //YA VOY MIJO XD    
    }

    function BuscarTodos()
    {
        $ColegiosDB = array();
        $conexionDB = new Conexion();

        $consultaSql = "SELECT * FROM `COLEGIOPROCEDENCIA`";

        $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

        if (mysqli_num_rows($respuestaDB) > 0)
        {
            while ($filasColegios = $respuestaDB->fetch_assoc())
            {
                $colegiosProcedencia = new ColegioProcedencia();
                $colegiosProcedencia->setId($filasColegios["id"]);
                $colegiosProcedencia->setNombre($filasColegios["nombre"]);
                $colegiosProcedencia->setActive($filasColegios["active"]);                

                $ColegiosDB[] = $this->dismount($colegiosProcedencia);
            }
        }
        else
        {
            $ColegiosDB = null;
        }

        $conexionDB->CerrarConexion();
        return $ColegiosDB;
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