<?php
class DALDiaHabil
{
    function NuevoDiaHabil($nuevoDiaHabil)
    {
        $nuevoDia = new DiaHabil();
        $conexionDB = new Conexion();
        $conexionDB->NuevaConexion2();

        $consultaSql = "INSERT INTO `DIAHABIL` (`DIA`) VALUES ('" . $nuevoDiaHabil . "')";

        if ($conexionDB->NuevaConsulta($consultaSql))
        {            
            $consultaSql = "SELECT * FROM `DIAHABIL` WHERE `DIA` = '".$nuevoDiaHabil."' AND `ACTIVE` = 1";
            $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

            if (mysqli_num_rows($respuestaDB) > 0)
            {
                while ($filaDiaHabil = $respuestaDB->fetch_assoc())
                {
                    $nuevoDia->setId($filaDiaHabil['id']);
                    $nuevoDia->setDia($filaDiaHabil['dia']);
                    $nuevoDia->setidConfiguracion($filaDiaHabil['idConfiguracion']);
                    $nuevoDia->setVisible($filaDiaHabil['visible']);
                    $nuevoDia->setActive($filaDiaHabil['active']);
                }
            }
            else
            {
                $nuevoDia = null;
            }
        }
        
        $nuevoDia = $this->dismount($nuevoDia);
        $conexionDB->CerrarConexion();
        return $nuevoDia;
    }

    function ModificarDiaHabil($idDia, $numeroFuncion)
    {

        $resultado = false;
        $conexionDB = new Conexion();
        $conexionDB->NuevaConexion2();

        if ($numeroFuncion == 0) //Ocultar Visibilidad
        {
            $consultaSql = "UPDATE `DIAHABIL` SET `VISIBLE` = 0 WHERE `ID`='" . $idDia . "'";
        }
        else if ($numeroFuncion == 1) //Habilitar Visibilidad
        {
            $consultaSql = "UPDATE `DIAHABIL` SET `VISIBLE` = 1 WHERE `ID`='" . $idDia . "'";
        }
        else if ($numeroFuncion == "del") //Desactivar (Eliminar)
        {
            $consultaSql = "UPDATE `DIAHABIL` SET `VISIBLE` = 0, `ACTIVE` = 0 WHERE `ID`='" . $idDia . "'";
        }

        if ($conexionDB->NuevaConsulta($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function CambiarDatosDiaHabil($idDiaModificar, $nuevoDia)
    {
        $resultado = false;
        $conexionDB = new Conexion();
        $conexionDB->NuevaConexion2();

        $consultaSql = "UPDATE `DIAHABIL` SET `DIA` = '" . $nuevoDia . "'
        WHERE `ID` = '" . $idDiaModificar . "'";

        if ($conexionDB->NuevaConsulta($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function BuscarIdDia($idDia)
    {
        $buscarDia = new DiaHabil();
        $conexionDB = new Conexion();
        $conexionDB->NuevaConexion2();

        $consultaSql = "SELECT * FROM `DIAHABIL` WHERE `ID` =" . $idDia;

        $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

        if (mysqli_num_rows($respuestaDB) > 0)
        {
            while ($filaHorario = $respuestaDB->fetch_assoc())
            {
                $buscarDia->setId($filaHorario['id']);
                $buscarDia->setDia($filaHorario['dia']);
                $buscarDia->setidConfiguracion($filaHorario['idConfiguracion']);
                $buscarDia->setVisible($filaHorario['visible']);
                $buscarDia->setActive($filaHorario['active']);
            }
        }
        else
        {
            $buscarDia = null;
        }

        $buscarDia = $this->dismount($buscarDia);
        $conexionDB->CerrarConexion();
        return $buscarDia;
    }

    function BuscarTodas()
    {
        $DiasHabilesDB = array();
        $conexionDB = new Conexion();
        $conexionDB->NuevaConexion2();

        $consultaSql = "SELECT * FROM `DIAHABIL`";

        $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

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

    // function cantidadDias($idConfiguracion)
    // {        
    //     $contadorDias = 0;
    //     $conexionDB = new Conexion();

    //     $consultaSql = "SELECT COUNT(`IDCONFIGURACION`) FROM `DIAHABIL` WHERE `IDCONFIGURACION` = '".$idConfiguracion."'";
    //     $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

    //     if($respuestaDB > 0)
    //     {
    //         $contadorDias = $respuestaDB;
    //     }
    //     else
    //     {
    //         $contadorDias = null;
    //     }

    //     $conexionDB->CerrarConexion();
    //     return $contadorDias;
    // }
}

///////////////////////////////////////////////////////////////////////////////////////////