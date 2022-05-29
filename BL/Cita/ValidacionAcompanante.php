<?php
    include '../../Core/GenerarPDF/fpdf/fpdf.php';
    include '../../Core/Conexion.php';
    include '../../DAL/CitaDAL/DALAsistente.php';
    include '../../DAL/CitaDAL/DALAcompanante.php';
    include '../../Entidades/CitasEntidades/Asistente.php';    

    $acompananteDAL = new DALAcompanante();
    $tipoValidacion = $_POST[''];

    switch($tipoValidacion)
    {
        case ""://Validar Cedula (en ambas tablas...)
            $cedulaAcompanante = $_POST[''];
            if($acompananteDAL->BuscarCedula($cedulaAcompanante))
                echo true;
            else
                echo false;
            break;
        default:
            echo "Ocurrió un error...";
            break;
    }