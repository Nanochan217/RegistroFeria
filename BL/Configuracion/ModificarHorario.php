<?php
session_start();
if ($_SESSION['Perfil'] != 1)
    header("Location: ../../GUI/PantallasDestino/AccesoDenegado.php");

include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALHorario.php';
include '../../Entidades/ConfiguracionEntidades/Horario.php';

$horarioDAL = new DALHorario();
$horario = new Horario();

//Funcion Solicitada
$funcionHorario = $_POST['campo'];

switch ($funcionHorario)
{
    case "": //Modificar Hora Inicio
            $idHorario = $_POST['id'];
            $horaInicio = $_POST[''];                                       
            if ($horarioDAL->CambiarHoraInicio($idHorario, $horaInicio))
                echo true;
            else echo false;
        break;

    case "": //Modificar Hora Final
            $idHorario = $_POST['id'];
            $horaFinal = $_POST[''];
            if ($horarioDAL->CambiarHoraFinal($idHorario, $horaFinal))
                echo true;
            else echo false;
        break;

    case "": //Modificar Aforo Maximo
            $idHorario = $_POST['id'];
            $aforoMaximo = $_POST[''];
            if ($horarioDAL->CambiarAforoMaximo($idHorario, $aforoMaximo))
                echo true;
            else echo false;
        break;

    case "actualizarHorarioVisible":
            $idHorario = $_POST['id'];
            $numeroFuncion = $_POST['horarioVisible'];
            if ($numeroFuncion == 0) //Habilitar Visibilidad
            {
                if ($horarioDAL->ModificarHorario($idHorario, 0))
                    echo true;
                else echo false;
            }
            else if ($numeroFuncion == 1) //Deshabilitar Visibilidad
            {
                if ($horarioDAL->ModificarHorario($idHorario, 1))
                    echo true;
                else echo false;
            }
        break;

    case "actualizarHorarioActive":
            $idHorario = $_POST['id'];
            $numeroFuncion = $_POST['horarioActive'];
            if ($numeroFuncion == 0) //Desactivar
            {
                if ($horarioDAL->ModificarHorario($idHorario, "del"))
                    echo true;
                else echo false;
            }
        break;

    case "": //Nuevo Horario
            if ($horarioDAL->NuevoHorario($i))
                echo true;
            else echo false;
        break;

    default:
        echo "Ocurrió un error";
        break;
}    
    
///////////////////////////////////////////////////////////////////////////////////////////