<?php
include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALConfiguracion.php';
include '../../Entidades/ConfiguracionEntidades/Configuracion.php';

function BuscarConfiguraciones()
{
    $ConfiguracionDAL = new DALConfiguracion();
    return json_encode($ConfiguracionDAL->BuscarTodasConfiguraciones());
}

function BuscarDiasHabiles()
{
    $ConfiguracionDAL = new DALConfiguracion();
    return json_encode($ConfiguracionDAL->BuscarTodasConfiguraciones());
}
