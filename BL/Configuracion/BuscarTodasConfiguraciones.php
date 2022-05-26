<?php
include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALConfiguracion.php';
include '../../DAL/ConfiguracionDAL/DALDiaHabil.php';
include '../../DAL/ConfiguracionDAL/DALHorario.php';
include '../../Entidades/ConfiguracionEntidades/Configuracion.php';
include '../../Entidades/ConfiguracionEntidades/DiaHabil.php';
include '../../Entidades/ConfiguracionEntidades/Horario.php';

//Buscar todas las configuraciones y sus datos relacionados
function BuscarConfiguraciones()
{
    $ConfiguracionDAL = new DALConfiguracion();
    return json_encode($ConfiguracionDAL->BuscarTodasConfiguraciones());
}

function BuscarDiasHabiles()
{
    $DiaHabilDAL = new DALDiaHabil();
    return json_encode($DiaHabilDAL->BuscarTodas());
}

function BuscarHorarios()
{
    $HorarioDAL = new DALHorario();
    return json_encode($HorarioDAL->BuscarTodas());
}

///////////////////////////////////////////////////////////////////////////////////////////