<?php
include '../../Core/Conexion.php';
include '../../DAL/CitaDAL/DALAsistente.php';
include '../../DAL/CitaDAL/DALAcompanante.php';
include '../../Entidades/CitasEntidades/Asistente.php';

$asistenteDAL = new DALAsistente();
$tipoValidacion = $_POST['campo'];

switch ($tipoValidacion)
{
    case "cedula": //Validar Cedula (en ambas tablas...)
        $cedulaAsistente = $_POST['cedula'];
        if ($asistenteDAL->BuscarCedula($cedulaAsistente))
            echo 1;
        else
            echo 0;
        break;
    case "email": //Validar Correo
        $correoAsistente = $_POST['email'];
        if ($asistenteDAL->BuscarCorreo($correoAsistente))
            echo 1;
        else
            echo 0;
        break;
    case "telefono": //Validar Telefono
        $telefonoAsistente = $_POST['telefono'];
        if ($asistenteDAL->BuscarTelefono($telefonoAsistente))
            echo 1;
        else
            echo 0;
        break;
    default:
        echo "Ocurrió un error...";
        break;
}
