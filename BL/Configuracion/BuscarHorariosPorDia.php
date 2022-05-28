<?php

include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALHorario.php';
include '../../Entidades/ConfiguracionEntidades/Horario.php';

$campo = $_POST['campo'];
$idDia = $_POST['id'];

if ($campo == "buscarHorarioIdDia")
{
    $horarioDAL = new DALHorario();
    return json_encode($horarioDAL->BuscarHorario(1, $idDia));
}
else if($campo == "")
{
    $horarioDAL = new DALHorario();
    return json_encode($horarioDAL->BuscarTodosHorarioIdDia($idDia));
}


