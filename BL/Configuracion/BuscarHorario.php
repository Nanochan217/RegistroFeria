<?php

include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALHorario.php';
include '../../Entidades/ConfiguracionEntidades/Horario.php';

//Buscar Horarios por ID
function BuscarIDHorario($id)
{
    $horarioDAL = new DALHorario();
    return json_encode($horarioDAL->BuscarIdHorario($id));
}

///////////////////////////////////////////////////////////////////////////////////////////