<?php
    include '../../Core/Conexion.php';    
    include '../../DAL/ConfiguracionDAL/DALHorario.php';
    include '../../Entidades/ConfiguracionEntidades/Horario.php';          

    $horarioDAL = new DALHorario();
    $horario = new Horario();

    //Funcion Solicitada
    $funcionHorario = $_POST[''];

    //Datos del Horario
    $idHorario = $_POST['']; 
    $horaInicio = $_POST[''];
    $horaFinal = $_POST[''];
    $aforoMaximo = $_POST[''];
    $idDiaHabil = $_POST[''];
    

    // $horario->setHoraInicio();
    // $horario->setHoraFinal();
    // $horario->setAforoMaximo();
    // $horario->setIdDiaHabil();
    // $horario->setVisible();
    // $horario->setActive();

    switch($funcionHorario)
    {
        case "A"://Modificar (Visibilidad o Desactivar)
                $numeroFuncion = $_POST[''];

                if($numeroFuncion == 1)//Ocultar Visibilidad
                {
                    if($horarioDAL->ModificarHorario(1, $idHorario))
                        echo true;
                    else echo false;
                }
                else if($numeroFuncion == 2)//Desactivar
                {
                    if($horarioDAL->ModificarHorario(2, $idHorario))
                        echo true;
                    else echo false;
                }
                else if($numeroFuncion == 3)//Habilitar Visibilidad
                {
                    if($horarioDAL->ModificarHorario(3, $idHorario))
                        echo true;
                    else echo false;
                }
            break;

        case "B"://Modificar Datos
                if($horarioDAL->CambiarDatosHorario($i))
                    echo true;
                else echo false;
            break;

        case "C"://Nuevo Horario
                if($horarioDAL->NuevoHorario($i))
                    echo true;
                else echo false;
            break;

        default:
            echo "Ocurrió un error";
            break;
    }    
    
///////////////////////////////////////////////////////////////////////////////////////////