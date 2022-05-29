<?php

include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALConfiguracion.php';
include '../../DAL/ConfiguracionDAL/DALHorario.php';
include '../../DAL/ConfiguracionDAL/DALDiaHabil.php';
include '../../DAL/CitaDAL/DALColegioProcedencia.php';
include '../../Entidades/ConfiguracionEntidades/Configuracion.php';
include '../../Entidades/ConfiguracionEntidades/Horario.php';
include '../../Entidades/ConfiguracionEntidades/DiaHabil.php';
include '../../Entidades/CitasEntidades/ColegioProcedencia.php';

//Buscar Todos los Datos relacionados a Configuracion de Formulario y Citas
function BuscarEstadoConfiguracion()
{
    $configuracionDAL = new DALConfiguracion();
    return $configuracionDAL->BuscarEstadoConfiguracion();
}

function BuscarHorarios()
{
    $horarioDAL = new DALHorario();
    return json_encode($horarioDAL->BuscarTodas());
}

function BuscarDias()
{
    $diaHabilDAL = new DALDiaHabil();
    return json_encode($diaHabilDAL->BuscarTodas());
}

function BuscarTodosColegios()
{
    $colegiosProcedenciaDAL = new DALColegioProcedencia();
    return json_encode($colegiosProcedenciaDAL->BuscarTodos());
}

///////////////////////////////////////////////////////////////////////////////////////////