<?php

include '../../Core/Conexion.php';
include '../../DAL/CitaDAL/DALColegioProcedencia.php';
include '../../Entidades/CitasEntidades/ColegioProcedencia.php';

function BuscarTodosColegios()
{
    $colegiosDAL = new DALColegioProcedencia();
    return json_encode($colegiosDAL->BuscarTodos());
}
