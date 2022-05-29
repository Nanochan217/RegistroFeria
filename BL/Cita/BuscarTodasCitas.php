<?php

    include '../../Core/Conexion.php';
    include '../../DAL/CitaDAL/DALCita.php';
    include '../../Entidades/CitasEntidades/Cita.php';

    //Buscar todas las Citas
    function BuscarTodasCitas()
    {
        $citaDAL = new DALCita();
        echo json_encode($citaDAL->BuscarTodasCitas());
    }

    //Buscar Citas por ID de Asistente
    function BuscarCitaId($idAsistente)
    {
        $citaDAL = new DALCita();
        echo json_encode($citaDAL->BuscarCita($idAsistente));
    }