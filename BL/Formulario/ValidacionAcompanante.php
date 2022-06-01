<?php
include '../../Core/Conexion.php';
include '../../DAL/CitaDAL/DALAsistente.php';
include '../../DAL/CitaDAL/DALAcompanante.php';
include '../../Entidades/CitasEntidades/Asistente.php';

$acompananteDAL = new DALAcompanante();
$tipoValidacion = $_POST['campo'];

switch ($tipoValidacion)
{
    case "cedula": //Validar Cedula (en ambas tablas...)
        $cedulaAcompanante = $_POST['cedula'];
        if ($acompananteDAL->BuscarCedula($cedulaAcompanante))
            echo 1;
        else
            echo 0;//"Esta cédula ya esta registrada"
        break;
    default:
        echo "Ocurrió un error...";
        break;
}
