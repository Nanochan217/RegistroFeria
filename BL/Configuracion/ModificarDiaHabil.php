<?php
session_start();
if ($_SESSION['Perfil'] != 1)
    header("Location: ../../GUI/PantallasDestino/AccesoDenegado.php");

include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALDiaHabil.php';
include '../../Entidades/ConfiguracionEntidades/DiaHabil.php';

$diaHabil = new DiaHabil();
$diaHabilDAL = new DALDiaHabil();
$funcionDia = $_POST['campo'];

switch ($funcionDia)
{
    case "actualizarDia": //Modificar
        $idDia = $_POST['id'];
        $dia = $_POST['dia'];
        if ($diaHabilDAL->CambiarDatosDiaHabil($idDia, $dia))
            echo true;
        else echo false;
        break;

    case "actualizarDiaVisible": //Visibilidad
        $idDia = $_POST['id'];
        $numeroFuncion = $_POST['diaVisible'];
        if ($numeroFuncion == 0) //Habilitar Visibilidad
        {
            if ($diaHabilDAL->ModificarDiaHabil($idDia, 0))
                echo true;
            else echo false;
        }
        else if ($numeroFuncion == 1) //Deshabilitar Visibilidad
        {
            if ($diaHabilDAL->ModificarDiaHabil($idDia, 1))
                echo true;
            else echo false;
        }
        break;

    case "actualizarDiaActive": //Desactivar
        $idDia = $_POST['id'];
        $numeroFuncion = $_POST['diaActive'];
        if ($numeroFuncion == 0) //Desactivar
        {
            if ($diaHabilDAL->ModificarDiaHabil($idDia, "del"))
                echo true;
            else echo false;
        }
        break;

    case "nuevoDia": //Nuevo Dia
        $nuevoDia = $_POST['dia'];
        echo json_encode($diaHabilDAL->NuevoDiaHabil($nuevoDia));        
        break;

    default:
        echo "Ocurrió un error";
        break;
}

///////////////////////////////////////////////////////////////////////////////////////////                