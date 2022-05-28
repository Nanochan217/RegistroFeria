<?php
    include '../../../Core/Conexion.php';
    include '../../../DAL/ConfiguracionDAL/DALConfiguracion.php';   
    include '../../..';    

    $configuracionDAL = new DALConfiguracion();
    $estadoConfiguracion = $_POST['estadoConfiguracion'];

    if($estadoConfiguracion == false)
    {
        echo $configuracionDAL->DisponibilidadConfiguracion($estadoConfiguracion);
    }
    else
    {
        echo $configuracionDAL->DisponibilidadConfiguracion($estadoConfiguracion);
    }
