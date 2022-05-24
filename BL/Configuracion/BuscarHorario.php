<?php

include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALHorario.php';
include '../../Entidades/ConfiguracionesEntidades/Horario.php';

function BuscarIDHorario($id)
{
    $horarioDAL = new DALHorario();
    return json_encode($horarioDAL->BuscarIdHorario($id));
}