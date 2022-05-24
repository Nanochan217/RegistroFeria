<?php

include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALHorario.php';
include '../../Entidades/ConfiguracionesEntidades/Horario.php';

function BuscarHorarios()
{
    $HorarioDAL = new DALHorario();
    return json_encode($HorarioDAL->BuscarTodas());
}