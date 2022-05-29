<?php
class DALHorario
{
    function NuevoHorario(Horario $nuevoHorario)
    {        
        $conexionDB = new Conexion();
        $conexionDB->NuevaConexion2();

        $consultaSql = "INSERT INTO `HORARIO` (`HORAINICIO`, `HORAFINAL`, `IDDIAHABIL`)
        VALUES ('" . $nuevoHorario->getHoraInicio() . "', '" . $nuevoHorario->getHoraFinal() . "',
        '" . $nuevoHorario->getIdDiaHabil() . "')";

        if ($conexionDB->NuevaConsulta($consultaSql))
        {            
            $consultaSql = "SELECT * FROM `HORARIO` WHERE `HORAINICIO` = '".$nuevoHorario->getHoraInicio()."' AND
            `HORAFINAL` = '".$nuevoHorario->getHoraFinal()."' AND `VISIBLE` = 1 AND `ACTIVE` = 1";
            $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

            if (mysqli_num_rows($respuestaDB) > 0)
            {
                while ($filaHorario = $respuestaDB->fetch_assoc())
                {
                    $nuevoHorario->setId($filaHorario['id']);
                    $nuevoHorario->setHoraInicio($filaHorario['horaInicio']);
                    $nuevoHorario->setHoraFinal($filaHorario['horaFinal']);
                    $nuevoHorario->setAforoMaximo($filaHorario['aforoMaximo']);
                    $nuevoHorario->setIdDiaHabil($filaHorario['idDiaHabil']);
                    $nuevoHorario->setVisible($filaHorario['visible']);
                    $nuevoHorario->setActive($filaHorario['active']);
                }
            }
            else
            {
                $nuevoHorario = null;
            }
        }
        
        $nuevoHorario = $this->dismount($nuevoHorario);

        $conexionDB->CerrarConexion();
        return $nuevoHorario;
    }

    function ModificarHorario($idHorario, $numeroFuncion)
    {
        $resultado = false;
        $conexionDB = new Conexion();
        $conexionDB->NuevaConexion2();

        if ($numeroFuncion == 0) //Ocultar Visibilidad
        {
            $consultaSql = "UPDATE `HORARIO` SET `VISIBLE` = 0 WHERE `ID`='" . $idHorario . "'";
        }
        else if ($numeroFuncion == 1) //Habilitar Visibilidad
        {
            $consultaSql = "UPDATE `HORARIO` SET `VISIBLE` = 1 WHERE `ID`='" . $idHorario . "'";
        }
        else if ($numeroFuncion == "del") //Desactivar (Eliminar)
        {
            $consultaSql = "UPDATE `HORARIO` SET `VISIBLE` = 0, `ACTIVE` = 0 WHERE `ID`='" . $idHorario . "'";
        }

        if ($conexionDB->NuevaConsulta($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function CambiarHoraInicio($idHorario, $horaInicio)
    {
        $resultado = false;
        $conexionDB = new Conexion();
        $conexionDB->NuevaConexion2();

        $consultaSql = "UPDATE `HORARIO` SET `HORAINICIO`='" . $horaInicio . "'            
        WHERE `ID`='" . $idHorario . "'";

        if ($conexionDB->NuevaConsulta($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function CambiarHoraFinal($idHorario, $horaFinal)
    {
        $resultado = false;
        $conexionDB = new Conexion();
        $conexionDB->NuevaConexion2();

        $consultaSql = "UPDATE `HORARIO` SET `HORAFINAL`='" . $horaFinal . "' 
        WHERE `ID`='" . $idHorario . "'";

        if ($conexionDB->NuevaConsulta($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function CambiarAforoMaximo($idHorario, $aforoMaximo)
    {
        $resultado = false;
        $conexionDB = new Conexion();
        $conexionDB->NuevaConexion2();

        $consultaSql = "UPDATE `HORARIO` SET `AFOROMAXIMO`='" . $aforoMaximo . "'
        WHERE `ID`='" . $idHorario . "'";

        if ($conexionDB->NuevaConsulta($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function BuscarHorario($funcionSolicitada, $id)
    {
        $buscarHorario = new Horario();
        $conexionDB = new Conexion();
        $conexionDB->NuevaConexion2();

        if ($funcionSolicitada == 0)
        {
            $consultaSql = "SELECT * FROM `HORARIO` WHERE `ID` = '" . $id . "' AND `ACTIVE` = 1";
        }
        else if ($funcionSolicitada == 2)
        {
            $consultaSql = "SELECT * FROM `HORARIO` WHERE `IDDIAHABIL` = '" . $id . "' AND `ACTIVE` = 1";
        }

        $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

        if (mysqli_num_rows($respuestaDB) > 0)
        {
            while ($filaHorario = $respuestaDB->fetch_assoc())
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

        $buscarHorario = $this->dismount($buscarHorario);
        $conexionDB->CerrarConexion();
        return $buscarHorario;
    }

    function BuscarUltimoHorario()
    {
        $idUltimoHorario = 0;
        $conexionDB = new Conexion();
        $conexionDB->NuevaConexion2();

        $consultaSql = "SELECT * FROM `HORARIO` WHERE `ID` = (SELECT MAX(`ID`) FROM `HORARIO`) AND `ACTIVE` = 1";
        $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

        if (mysqli_num_rows($respuestaDB) > 0)
        {
            while ($filaHorario = $respuestaDB->fetch_assoc())
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

    function BuscarTodosHorarioIdDia($idDia)
    {
        $HorariosDB = array();
        $conexionDB = new Conexion();
        $conexionDB->NuevaConexion2();

        $consultaSql = "SELECT * FROM `HORARIO` WHERE `IDDIAHABIL` = '".$idDia."' AND `ACTIVE` = 1";

        $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

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

    function BuscarTodas()
    {
        $HorariosDB = array();
        $conexionDB = new Conexion();
        $conexionDB->NuevaConexion2();

        $consultaSql = "SELECT * FROM `HORARIO`";

        $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

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

///////////////////////////////////////////////////////////////////////////////////////////