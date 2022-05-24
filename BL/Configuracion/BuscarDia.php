<?php

include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALDiaHabil.php';
include '../../Entidades/ConfiguracionesEntidades/DiaHabil.php';

function BuscarIDDia($id)
{
    $diaHabilDAL = new DALDiaHabil();
    return json_encode($diaHabilDAL->BuscarIDDia($id));
}