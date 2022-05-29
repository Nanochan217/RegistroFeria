<?php

include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALHorario.php';
include '../../Entidades/ConfiguracionEntidades/Horario.php';

$idDia = $_POST['id'];

$horarioDAL = new DALHorario();
echo json_encode($horarioDAL->BuscarTodosHorarioIdDia($idDia));
