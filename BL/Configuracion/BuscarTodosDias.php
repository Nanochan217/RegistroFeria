<?php

include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALDiaHabil.php';
include '../../Entidades/ConfiguracionesEntidades/DiaHabil.php';

function BuscarDias()
{
    $DiaHabilDAL = new DALDiaHabil();
    return json_encode($DiaHabilDAL->BuscarTodas());
}