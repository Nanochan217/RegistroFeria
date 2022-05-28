<?php
include '../../Core/Conexion.php';
include '../../DAL/ConfiguracionDAL/DALDiaHabil.php';
include '../../Entidades/ConfiguracionEntidades/DiaHabil.php';

    $diaHabilDAL = new DALDiaHabil();
    $diaHabil = new DiaHabil();

    $funcionDia = $_POST[''];
    $dia = $_POST[''];    

    // $diaHabil->setDia($dia);
    // $diaHabil->setidConfiguracion(1);    

    switch($funcionDia)
    {
        case "A"://Modificar (Visibilidad o Desactivar)
                $numeroFuncion = $_POST[''];
                if($numeroFuncion == 1)//Ocultar Visibilidad
                {
                    if($diaHabilDAL->ModificarDiaHabil(1))
                        echo true;
                    else echo false;
                }
                else if($numeroFuncion == 2)//Desactivar
                {
                    if($diaHabilDAL->ModificarDiaHabil(2))
                        echo true;
                    else echo false;
                }
                else if($numeroFuncion == 3)//Habilitar Visibilidad
                {
                    if($diaHabilDAL->ModificarDiaHabil(3))
                        echo true;
                    else echo false;
                }
            break;

switch ($campo)
{
    case "A": //Modificar (Visibilidad o Desactivar)
        $numeroFuncion = $_POST[''];
        if ($numeroFuncion == 1) //Ocultar Visibilidad
        {
            if ($diaHabilDAL->ModificarDiaHabil(1))
                echo true;
            else echo false;
        }
        else if ($numeroFuncion == 2) //Desactivar
        {
            if ($diaHabilDAL->ModificarDiaHabil(2))
                echo true;
            else echo false;
        }
        else if ($numeroFuncion == 3) //Habilitar Visibilidad
        {
            if ($diaHabilDAL->ModificarDiaHabil(3))
                echo true;
            else echo false;
        }
        break;

    case "B": //Modificar Datos
        if ($diaHabilDAL->CambiarDatosDiaHabil($i))
            echo true;
        else echo false;
        break;

    case "C": //Nuevo Dia
        if ($diaHabilDAL->CambiarDatosDiaHabil($i))
            echo true;
        else echo false;
        break;

    default:
        echo "Ocurrió un error";
        break;
}

///////////////////////////////////////////////////////////////////////////////////////////                