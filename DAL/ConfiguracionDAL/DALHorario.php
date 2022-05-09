<?php
class DALHorario
{
    function NuevoHorario(Horario $nuevoHorario)
    {
        $resultado = false;
        $conexionDB = new Conexion();

        $consultaSql = "INSERT INTO `HORARIO` (`HORAINICIO`, `HORAFINAL`, `AFOROMAXIMO`, `IDDIAHABIL`, `VISIBLE`, `ACTIVE`)
            VALUES ('".$nuevoHorario->getHoraInicio()."', '".$nuevoHorario->getHoraFinal()."', '".$nuevoHorario->getAforoMaximo()."',
            '".$nuevoHorario->getIdDiaHabil()."', 1, 1)";

        if($conexionDB->NuevaConexion($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function ModificarHorario(Horario $modificarHorario)
    {
        $resultado = false;
        $conexionDB = new Conexion();
        //OJO CON EL WHERE!!!
        $consultaSql = "UPDATE `HORARIO` SET `HORAINICIO`='".$modificarHorario->getHoraInicio()."',
        `HORAFINAL`='".$modificarHorario->getHoraFinal()."', `AFOROMAXIMO`='".$modificarHorario->getAforoMaximo()."'
        WHERE `IDDIAHABIL`='".$modificarHorario->getIdDiaHabil()."'";
        //VER SI SE PUEDE USAR VALUES () EN VEZ DE SETS CONSECUTIVOS
        if($conexionDB->NuevaConexion($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function EliminarHorario($idHorario)
    {
        $resultado = false;
        $conexionDB = new Conexion();
        //OJO CON EL WHERE!!!
        $consultaSql = "UPDATE `HORARIO` SET `VISIBLE` = 0, `ACTIVE` = 0 WHERE `ID`='".$idHorario."'";

        if($conexionDB->NuevaConexion($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function BuscarIdHorario($idHorario)
    {
        $buscarHorario = new Horario();
        $conexionDB = new Conexion();

        $consultaSql = "SELECT * FROM `HORARIO` WHERE `ID`='".$idHorario."' AND `ACTIVE` = 1";
        $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

        if(mysqli_num_rows($respuestaDB)>0)
        {
            while($filaHorario = $respuestaDB->fetch_assoc())
            {
                $buscarHorario->setId($filaHorario['id']);
                $buscarHorario->setHoraInicio($filaHorario['horaInicio']);
                $buscarHorario->setHoraFinal($filaHorario['horaFinal']);
                $buscarHorario->setAforoMaximo($filaHorario['aforoMaximo']);
                $buscarHorario->setIdDiaHabil($filaHorario['idDiaHabil']);
                $buscarHorario->setVisible($filaHorario['visible']);
                $buscarHorario->setActive($filaHorario['active']);
            }
        }
        else
        {
            $buscarHorario = null;
        }        

        $conexionDB->CerrarConexion();
        return $buscarHorario;
    }

    function BuscarUltimoHorario()
    {
        $idUltimoHorario = 0;
        $conexionDB = new Conexion();

        $consultaSql = "SELECT * FROM `HORARIO` WHERE `ID`=(SELECT MAX(`ID`) FROM `HORARIO`) AND `ACTIVE` = 1";
        $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

        if(mysqli_num_rows($respuestaDB)>0)
        {
            while($filaHorario = $respuestaDB->fetch_assoc())
            {
                $idUltimoHorario = $filaHorario['id'];
            }
        }
        else
        {
            $idUltimoHorario = null;
        }        

        $conexionDB->CerrarConexion();
        return $idUltimoHorario;
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
