<?php
class DALDiaHabil
{
    function Nuevo()
    {
    }

    function ModificarDiaHabil()
    {
    }

    function Eliminar()
    {
    }

    function BuscarId($idConfiguracion)
    {
        //YA VOY MIJO XD
    }

    function cantidadDias($idConfiguracion)
    {        
        $contadorDias = 0;
        $conexionDB = new Conexion();

        $consultaSql = "SELECT COUNT(`IDCONFIGURACION`) FROM `DIAHABIL` WHERE `IDCONFIGURACION` = '".$idConfiguracion."'";
        $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

        if($respuestaDB > 0)
        {
            $contadorDias = $respuestaDB;
        }
        else
        {
            $contadorDias = null;
        }
        
        $conexionDB->CerrarConexion();
        return $contadorDias;
    }

    function BuscarTodas()
    {
        $DiasHabilesDB = array();
        $conexionDB = new Conexion();

        $consultaSql = "SELECT * FROM `DIAHABIL`";

        $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

        if (mysqli_num_rows($respuestaDB) > 0)
        {
            while ($filasDiasHabiles = $respuestaDB->fetch_assoc())
            {
                $diaHabil = new DiaHabil();
                $diaHabil->setId($filasDiasHabiles["id"]);
                $diaHabil->setDia($filasDiasHabiles["dia"]);
                $diaHabil->setidConfiguracion($filasDiasHabiles["idConfiguracion"]);
                $diaHabil->setVisible($filasDiasHabiles["visible"]);
                $diaHabil->setActive($filasDiasHabiles['active']);

                $DiasHabilesDB[] = $this->dismount($diaHabil);
            }
        }
        else
        {
            $DiasHabilesDB = null;
        }

        $conexionDB->CerrarConexion();
        return $DiasHabilesDB;
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
