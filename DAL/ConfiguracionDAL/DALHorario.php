<?php
class DALHorario
{
    function NuevoHorario(Horario $nuevoHorario)
    {
        $resultado = false;
        $conexionDB = new Conexion();

        $consultaSql = "INSERT INTO `HORARIO` (`HORAINICIO`, `HORAFINAL`, `AFOROMAXIMO`, `IDDIAHABIL`, `VISIBLE`, `ACTIVE`)
            VALUES ('".$nuevoHorario->getHoraInicio()."', '".$nuevoHorario->getHoraFinal()."', '".$nuevoHorario->getAforoMaximo()."',
            '".$nuevoHorario->getIdDiaHabil()."', 1, 1)";//OJO CON LOS ID DE DIA HABIL

        if ($conexionDB->NuevaConexion($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function ModificarHorario($numeroFuncion, $idHorario)
    {
        $resultado = false;
        $conexionDB = new Conexion();

        if($numeroFuncion == 0)//Ocultar Visibilidad
        {
            $consultaSql = "UPDATE `HORARIO` SET `VISIBLE` = 0 WHERE `ID`='".$idHorario."'";
        }
        else if($numeroFuncion == 1)//Habilitar Visibilidad
        {
            $consultaSql = "UPDATE `HORARIO` SET `VISIBLE` = 1 WHERE `ID`='".$idHorario."'";
        }
        else if($numeroFuncion == "del")//Desactivar (Eliminar)
        {
            $consultaSql = "UPDATE `HORARIO` SET `VISIBLE` = 0, `ACTIVE` = 0 WHERE `ID`='".$idHorario."'";
        }        

        if($conexionDB->NuevaConexion($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function CambiarDatosHorario($idHorario, Horario $modificarHorario)
    {
        $resultado = false;
        $conexionDB = new Conexion();

        $consultaSql = "UPDATE `HORARIO` SET `HORAINICIO`='" . $modificarHorario->getHoraInicio() . "',
            `HORAFINAL`='".$modificarHorario->getHoraFinal()."', `AFOROMAXIMO`='".$modificarHorario->getAforoMaximo()."'
            WHERE `ID`='".$idHorario."'";//OJO, NO SE SI ME PASAN EL ID DE DIA O HORARIO

        if ($conexionDB->NuevaConexion($consultaSql))
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

        if($funcionSolicitada == 0)
        {
            $consultaSql = "SELECT * FROM `HORARIO` WHERE `ID` = '".$id."' AND `ACTIVE` = 1";
        }
        else if($funcionSolicitada == 2)
        {
            $consultaSql = "SELECT * FROM `HORARIO` WHERE `IDDIAHABIL` = '".$id."' AND `ACTIVE` = 1";
        }        

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

        $buscarHorario = $this->dismount($buscarHorario);
        $conexionDB->CerrarConexion();
        return $buscarHorario;        
    }

    function BuscarUltimoHorario()
    {
        $idUltimoHorario = 0;
        $conexionDB = new Conexion();

        $consultaSql = "SELECT * FROM `HORARIO` WHERE `ID` = (SELECT MAX(`ID`) FROM `HORARIO`) AND `ACTIVE` = 1";
        $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

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

        $consultaSql = "SELECT * FROM `HORARIO` WHERE `IDDIAHABIL` = '".$idDia."'";

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

    function BuscarTodos()
    {
        $HorariosDB = array();
        $conexionDB = new Conexion();

        $consultaSql = "SELECT * FROM `HORARIO`";

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

///////////////////////////////////////////////////////////////////////////////////////////