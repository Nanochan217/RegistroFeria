<?php
class DALConfiguracion
{
    function ModificarConfiguracion(Configuracion $nuevaConfiguracion)
    {
        $conexionDB = new Conexion();
        $resultado = false;

        $consultaSql = "UPDATE `CONFIGURACION` 
            SET `FECHAINICIO` = '".$nuevaConfiguracion->getFechaInicio()."', 
            `FECHAFINAL` = '".$nuevaConfiguracion->getFechaFinal()."', 
            `ACOMPANANTESMAXIMO` = '".$nuevaConfiguracion->getAcompanantesMax()."' 
            WHERE `ID` = 1";
        
        if($conexionDB->NuevaConexion($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function DesactivarConfiguracion()
    {
        $conexionDB = new Conexion();
        $resultado = false;

        $consultaSql = "UPDATE `CONFIGURACION`, `DIAHABIL`, `HORARIO`
            SET `CONFIGURACION.ESTADOCONFIGURACION` = 0, `DIAHABIL.VISIBLE` = 0, 
            `HORARIO.VISIBLE` = 0 WHERE `CONFIGURACION.ID` = 1";

        if($conexionDB->NuevaConexion($consultaSql))
        {
            $resultado = true;
        }

        $conexionDB->CerrarConexion();
        return $resultado;
    }

    function ActivarConfiguracion()
    {
        $conexionDB = new Conexion();
        $resultado = false;

        $consultaSql = "UPDATE `CONFIGURACION`, `DIAHABIL`, `HORARIO`
        SET `CONFIGURACION.ESTADOCONFIGURACION` = 1, `DIAHABIL.VISIBLE` = 1, 
        `HORARIO.VISIBLE` = 1 WHERE `CONFIGURACION.ID` = 1";
        if($conexionDB->NuevaConexion($consultaSql))
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
                $configuracion->setNombre($filasConfiguracion["nombre"]);
                $configuracion->setDescripcion($filasConfiguracion["descripcion"]);
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

///////////////////////////////////////////////////////////////////////////////////////////