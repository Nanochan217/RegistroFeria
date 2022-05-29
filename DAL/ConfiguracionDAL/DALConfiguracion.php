<?php
class DALConfiguracion
{
    function ModificarConfiguracion($fechaInicial, $fechaFinal, $acompanantesMax)
    {
        $conexionDB = new Conexion();
        $resultado = false;

        if (isset($fechaInicial))
        {
            $consultaSql = "UPDATE `CONFIGURACION` 
            SET `FECHAINICIO` = '" . $fechaInicial . "' WHERE `ID` = 1";
        }
        else if (isset($fechaFinal))
        {
            $consultaSql = "UPDATE `CONFIGURACION` 
            SET `FECHAFINAL` = '" . $fechaFinal . "' WHERE `ID` = 1";
        }
        if (isset($acompanantesMax))
        {
            $consultaSql = "UPDATE `CONFIGURACION` 
            SET `ACOMPANANTESMAXIMO` = '" . $acompanantesMax . "' WHERE `ID` = 1";
        }

        if ($conexionDB->NuevaConexion($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function BuscarEstadoConfiguracion()
    {
        $conexionDB = new Conexion();
        $resultado = false;

        $consultaSql = "SELECT * FROM `CONFIGURACION` WHERE `ID` = 1 AND 
        `ESTADOCONFIGURACION` = 1 AND `ACTIVE` = 1";

        $respuestaDB = $conexionDB->NuevaConexion($consultaSql);
        if (mysqli_num_rows($respuestaDB) > 0)
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function DisponibilidadConfiguracion($estadoConfiguracion)
    {
        $conexionDB = new Conexion();
        $resultado = false;

        if ($estadoConfiguracion == 0) //Deshabilitar
        {
            $consultaSql = "UPDATE `CONFIGURACION`
            SET `ESTADOCONFIGURACION` = FALSE";
        }
        else if ($estadoConfiguracion == 1) //Habilitar
        {
            //UPDATE configuracion SET estadoConfiguracion = TRUE;
            $consultaSql = "UPDATE `CONFIGURACION`
            SET `ESTADOCONFIGURACION` = TRUE";
        }

        if ($conexionDB->NuevaConexion($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function BuscarTodasConfiguraciones()
    {
        $configuracionesDB = array();
        $conexionDB = new Conexion();

        $consultaSql = "SELECT * FROM `CONFIGURACION` WHERE `ACTIVE` = 1";

        $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

        if (mysqli_num_rows($respuestaDB) > 0)
        {
            while ($filasConfiguracion = $respuestaDB->fetch_assoc())
            {
                $configuracion = new Configuracion();
                $configuracion->setId($filasConfiguracion["id"]);
                $configuracion->setFechaInicio($filasConfiguracion["fechaInicio"]);
                $configuracion->setFechaFinal($filasConfiguracion["fechaFinal"]);
                $configuracion->setAcompanantesMax($filasConfiguracion["acompanantesMaximo"]);
                $configuracion->setEstadoFormulario($filasConfiguracion["estadoConfiguracion"]);
                $configuracion->setActive($filasConfiguracion['active']);

                $configuracionesDB[] = $this->dismount($configuracion);
            }
        }
        else
        {
            $configuracionesDB = null;
        }

        $conexionDB->CerrarConexion();
        return $configuracionesDB;
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


// $consultaSql = "UPDATE `CONFIGURACION`, `DIAHABIL`, `HORARIO`
// SET `CONFIGURACION.ESTADOCONFIGURACION` = 0, `DIAHABIL.VISIBLE` = 0, 
// `HORARIO.VISIBLE` = 0 WHERE `CONFIGURACION.ID` = 1"; 
///////////////////////////////////////////////////////////////////////////////////////////