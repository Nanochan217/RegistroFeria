<?php

include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALHorario.php';
include '../../Entidades/ConfiguracionEntidades/Horario.php';

//Buscar Horarios por ID
function BuscarIDHorario($id)
{
    $horarioDAL = new DALHorario();
    return json_encode($horarioDAL->BuscarHorario(0, $id));
}

// function BuscarHorarioIdDia($idDiaHabil)
// {
//     $horarioDAL = new DALHorario();
//     return json_encode($horarioDAL->BuscarHorario(1, $idDiaHabil));
// }


///////////////////////////////////////////////////////////////////////////////////////////