<?php

include '../../Core/Conexion.php';
include '../../DAL/CitaDAL/DALColegio.php';
include '../../Entidades/CitasEntidades/ColegioProcedencia.php';

function BuscarHorarios()
{
    $colegiosDAL = new DALColegioProcedencia();
    return json_encode($colegiosDAL->BuscarTodos());
}