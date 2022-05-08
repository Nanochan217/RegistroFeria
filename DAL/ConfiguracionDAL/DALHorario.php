<?php
class DALHorario
{
    function Nuevo()
    {
    }

    function Modificar()
    {
    }

    function Eliminar()
    {
    }

    function BuscarId($idConfiguracion)
    {
    }

    function BuscarTodas()
    {
        $HorariosDB = array();
        $conexionDB = new Conexion();

        $consultaSql = "SELECT * FROM `HORARIO` WHERE `ACTIVE` = 1";

        $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

        if (mysqli_num_rows($respuestaDB) > 0)
        {
            while ($filasHorarios = $respuestaDB->fetch_assoc())
            {
                $horario = new Horario();
                $horario->setId($filasHorarios["id"]);
                $horario->setHoraInicio($filasHorarios["horaInicio"]);
                $horario->setHoraFinal($filasHorarios["horaFinal"]);
                $horario->setAforoMaximo($filasHorarios["aforoMaximo"]);
                $horario->setIdDiaHabil($filasHorarios["idDiaHabil"]);
                $horario->setVisible($filasHorarios["visible"]);
                $horario->setActive($filasHorarios['active']);

                $HorariosDB[] = $this->dismount($horario);
            }
        }
        else
        {
            $HorariosDB = null;
        }

        $conexionDB->CerrarConexion();
        return $HorariosDB;
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
