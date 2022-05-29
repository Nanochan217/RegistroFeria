<?php
    session_start();
    if($_SESSION['Perfil'] != 1)
        header("Location: ../../GUI/PantallasDestino/AccesoDenegado.php");
    
    include '../../Core/Conexion.php';    
    include '../../DAL/ConfiguracionDAL/DALHorario.php';
    include '../../Entidades/ConfiguracionEntidades/Horario.php';          

    $horarioDAL = new DALHorario();
    $horario = new Horario();

    //Funcion Solicitada
    $funcionHorario = $_POST[''];

    //Datos del Horario
    // $horaInicio = $_POST[''];
    // $horaFinal = $_POST[''];
    // $aforoMaximo = $_POST[''];
    // $idDiaHabil = $_POST[''];        

    switch($funcionHorario)
    {
        case ""://Modificar
                $idHorario = $_POST['id'];             
                // $horario->setHoraInicio($horaInicio);
                // $horario->setHoraFinal($horaFinal);
                // $horario->setAforoMaximo($aforoMaximo);
                // $horario->setIdDiaHabil($idDiaHabil);                           
                if ($horarioDAL->CambiarDatosHorario($idHorario, $horario))
                    echo true;
                else echo false;
            break;        

        case ""://Visibilidad
                $idHorario = $_POST['id'];
                $numeroFuncion = $_POST[''];
                if($numeroFuncion == 0)//Habilitar Visibilidad
                {
                    if($horarioDAL->ModificarHorario($idHorario, 0))
                        echo true;
                    else echo false;
                }
                else if($numeroFuncion == 1)//Deshabilitar Visibilidad
                {
                    if($horarioDAL->ModificarHorario($idHorario, 1))
                        echo true;
                    else echo false;
                }
            break;        
                
        case ""://Desactivar
                $idHorario = $_POST['id'];
                $numeroFuncion = $_POST[''];
                if($numeroFuncion == 0)//Desactivar
                {
                    if($horarioDAL->ModificarHorario($idHorario, "del"))
                        echo true;
                    else echo false;
                }            
            break;

        case ""://Nuevo Horario
                if ($horarioDAL->NuevoHorario($i))
                    echo true;
                else echo false;
            break;

        default:
            echo "Ocurrió un error";
            break;
    }    
    
///////////////////////////////////////////////////////////////////////////////////////////