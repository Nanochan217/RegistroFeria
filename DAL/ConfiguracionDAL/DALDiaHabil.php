<?php
class DALDiaHabil
{
    function NuevoDiaHabil(DiaHabil $nuevoDiaHabil)
    {
        $resultado = false;
        $conexionDB = new Conexion();

        $consultaSql = "INSERT INTO `DIAHABIL` (`DIA`,`IDCONFIGURACION`,`VISIBLE`,`ACTIVE`)
        VALUES ('".$nuevoDiaHabil->getDia()."', 1, 1, 1)";

        if($conexionDB->NuevaConexion($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function ModificarDiaHabil($numeroFuncion)
    {
        
        $resultado = false;
        $conexionDB = new Conexion();

        if($numeroFuncion == 1)//Ocultar Visibilidad
        {
            $consultaSql = "UPDATE `DIAHABIL` SET `VISIBLE` = 0";
        }
        else if($numeroFuncion == 2)//Desactivar (Eliminar)
        {
            $consultaSql = "UPDATE `DIAHABIL` SET `VISIBLE` = 0 AND `ACTIVE` = 0";
        }
        else if($numeroFuncion == 3)//Habilitar Visibilidad
        {
            $consultaSql = "UPDATE `DIAHABIL` SET `VISIBLE` = 1";
        }

        if($conexionDB->NuevaConexion($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }   

    function CambiarDatosDiaHabil(DiaHabil $modificarDiaHabil)
    {
        $resultado = false;
        $conexionDB = new Conexion();

        $consultaSql = "UPDATE `DIAHABIL` SET `DIA` = '".$modificarDiaHabil->getDia()."'
        WHERE `ID` = '".$modificarDiaHabil->getId()."'";

        if($conexionDB->NuevaConexion($consultaSql))
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

        $consultaSql = "SELECT * FROM `DIAHABIL` WHERE `ID` =".$idDia;

        $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

        if(mysqli_num_rows($respuestaDB)>0)
        {
            while($filaHorario = $respuestaDB->fetch_assoc())
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

///////////////////////////////////////////////////////////////////////////////////////////