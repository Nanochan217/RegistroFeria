<?php
    include '../../Core/GenerarPDF/fpdf/fpdf.php';
    include '../../Core/Conexion.php';
    include '../../DAL/CitaDAL/DALAsistente.php';
    include '../../DAL/CitaDAL/DALAcompanante.php';
    include '../../Entidades/CitasEntidades/Asistente.php';    

    $asistenteDAL = new DALAsistente();
    $tipoValidacion = $_POST[''];

    switch($tipoValidacion)
    {
        case ""://Validar Cedula (en ambas tablas...)
            $cedulaAsistente = $_POST[''];
            if($asistenteDAL->BuscarCedula($cedulaAsistente))
                echo true;
            else
                echo false;
            break;
        case ""://Validar Correo
            $correoAsistente = $_POST[''];
            if($asistenteDAL->BuscarCorreo($correoAsistente))
                echo true;
            else
                echo false;
            break;
        case ""://Validar Telefono
            $telefonoAsistente = $_POST[''];
            if($asistenteDAL->BuscarTelefono($telefonoAsistente))
                echo true;
            else
                echo false;
            break;
        default:
            echo "Ocurrió un error...";
            break;
    }