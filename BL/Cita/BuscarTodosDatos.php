<?php

include '../../Core/Conexion.php';
include '../../DAL/CitaDAL/DALColegioProcedencia.php';
include '../../DAL/ConfiguracionDAL/DALDiaHabil.php';
include '../../DAL/ConfiguracionDAL/DALHorario.php';
include '../../Entidades/CitasEntidades/ColegioProcedencia.php';
include '../../Entidades/ConfiguracionEntidades/DiaHabil.php';
include '../../Entidades/ConfiguracionEntidades/Horario.php';

function BuscarHorarios()
{
    $HorarioDAL = new DALHorario();
    return json_encode($HorarioDAL->BuscarTodas());
}

function BuscarDias()
{
    $DiaHabilDAL = new DALDiaHabil();
    return json_encode($DiaHabilDAL->BuscarTodas());
}

function BuscarTodosColegios()
{
    $colegiosDAL = new DALColegioProcedencia();
    return json_encode($colegiosDAL->BuscarTodos());
}
