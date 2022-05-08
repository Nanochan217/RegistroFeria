<?php
class DALConfiguracion
{
    function NuevaConfiguracion()
    {
    }

    function ModificarConfiguracion()
    {
    }

    function EliminarConfiguracion()
    {
    }

    function BuscarConfiguracionId($idConfiguracion)
    {
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
