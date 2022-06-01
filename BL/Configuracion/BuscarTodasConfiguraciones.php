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
    $configuracionDAL = new DALConfiguracion();
    return json_encode($configuracionDAL->BuscarTodasConfiguraciones());
}

function BuscarDiasHabiles()
{
    $DiaHabilDAL = new DALDiaHabil();
    return json_encode($DiaHabilDAL->BuscarTodosDias(0));
}

//Te devuelve un String!!!
function BuscarFechaLimite()
{
    $configuracionDAL = new DALConfiguracion();
    $fechaFinal = $configuracionDAL->BuscarDisponibilidad();
    echo json_encode($fechaFinal);
}
///////////////////////////////////////////////////////////////////////////////////////////