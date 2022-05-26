<?php

include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALDiaHabil.php';
include '../../Entidades/ConfiguracionEntidades/DiaHabil.php';

//Buscar dias por ID
function BuscarIDDia($id)
{
    $diaHabilDAL = new DALDiaHabil();
    return json_encode($diaHabilDAL->BuscarIDDia($id));
}

///////////////////////////////////////////////////////////////////////////////////////////