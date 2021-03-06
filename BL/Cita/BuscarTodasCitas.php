<?php

    include '../../Core/Conexion.php';
    include '../../DAL/CitaDAL/DALCita.php';
    include '../../DAL/CitaDAL/DALAsistente.php';
    include '../../DAL/CitaDAL/DALAcompanante.php';
    include '../../Entidades/CitasEntidades/Cita.php';
    include '../../Entidades/CitasEntidades/Acompanante.php';

    //Buscar todas las Citas
    function BuscarTodasCitas()
    {
        $citaDAL = new DALCita();
        return json_encode($citaDAL->BuscarTodasCitas());
    }

    //Buscar Citas por ID de Asistente
    function BuscarCitaId($idAsistente)
    {
        $citaDAL = new DALCita();
        echo json_encode($citaDAL->BuscarCita($idAsistente));
    }

    //Array
    function BuscarAsistente()
    {
        $asistenteDAL = new DALAsistente();
        return json_encode($asistenteDAL->BuscarTodosAsistentes());
    }

    //Objeto
    function BuscarAcompanante($id)
    {
        $acompananteDAL = new DALAcompanante();
        return json_encode($acompananteDAL->BuscarAcompananteIdCita($id));
    }    