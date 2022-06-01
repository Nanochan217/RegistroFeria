<?php

include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALConfiguracion.php';
include '../../DAL/ConfiguracionDAL/DALHorario.php';
include '../../DAL/ConfiguracionDAL/DALDiaHabil.php';
include '../../DAL/CitaDAL/DALColegioProcedencia.php';
include '../../DAL/CitaDAL/DALTipoAcompanante.php';
include '../../Entidades/ConfiguracionEntidades/Configuracion.php';
include '../../Entidades/ConfiguracionEntidades/Horario.php';
include '../../Entidades/ConfiguracionEntidades/DiaHabil.php';
include '../../Entidades/CitasEntidades/ColegioProcedencia.php';
include '../../Entidades/CitasEntidades/TipoAcompanante.php';

//Buscar Todos los Datos relacionados a Configuracion de Formulario y Citas
function BuscarConfiguracion()
{
    $configuracionDAL = new DALConfiguracion();
    return json_encode($configuracionDAL->BuscarTodasConfiguraciones());
}

//Devuelve los horarios con aforo actual menor o igual que el maximo
function BuscarHorarios()
{
    $horarioDAL = new DALHorario();
    return json_encode($horarioDAL->BuscarTodosHorarios(1));
}

//Devuelve los dias con horarios activos
function BuscarDias()
{
    $diaHabilDAL = new DALDiaHabil();
    return json_encode($diaHabilDAL->BuscarTodosDias(1));
}

function BuscarTodosColegios()
{
    $colegiosProcedenciaDAL = new DALColegioProcedencia();
    return json_encode($colegiosProcedenciaDAL->BuscarTodos());
}

function BuscarTodosTiposAcompanantes()
{
    $tipoAcompananteDAL = new DALTipoAcompanante();
    return json_encode($tipoAcompananteDAL->BuscarTodos());
}

// INSERT INTO TipoAcompanante (tipoAcompanante)
// VALUES ("Padre/Madre");

// INSERT INTO TipoAcompanante (tipoAcompanante)
// VALUES ("Encargado Legal");

// INSERT INTO TipoAcompanante (tipoAcompanante)
// VALUES ("Amigo(a)");

// INSERT INTO TipoAcompanante (tipoAcompanante)
// VALUES ("Otro...");

///////////////////////////////////////////////////////////////////////////////////////////