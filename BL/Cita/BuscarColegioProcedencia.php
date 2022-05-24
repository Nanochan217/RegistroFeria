<?php

include '../../Core/Conexion.php';
include '../../DAL/CitaDAL/DALColegioProcedencia.php';
include '../../Entidades/CitasEntidades/ColegioProcedencia.php';

function BuscarIDColegio($id)
{
    $colegioProcedenciaDAL = new DALColegioProcedencia();
    return json_encode($colegioProcedenciaDAL->BuscarIDColegio($id));
}