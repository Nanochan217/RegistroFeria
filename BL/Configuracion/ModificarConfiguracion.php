<?php
    include '../../Core/Conexion.php';    
    include '../../DAL/ConfiguracionDAL/DALConfiguracion.php';   
    include '../../Entidades/ConfiguracionEntidades/Configuracion.php';    

    $configuracionDAL = new DALConfiguracion();    
    $campo = $_POST['campo'];

    switch($campo)
    {
        case "estadoConfiguracion":
                $estadoConfiguracion = $_POST['estadoConfiguracion'];
                if($estadoConfiguracion == 1)
                {                    
                    if($configuracionDAL->DisponibilidadConfiguracion(1))
                    {
                        echo true;
                    }
                }
                else if($estadoConfiguracion == 2)
                {
                    if($configuracionDAL->DisponibilidadConfiguracion(2))
                    {
                        echo true;
                    }
                }
            break;

        case "fechaInicial";
                $fechaInicial = $_POST['fechaInicio'];
                if($configuracionDAL->ModificarConfiguracion($fechaInicial, null, null))
                {
                    echo true;
                }                
            break;

        case "fechaFinal";
                $fechaFinal = $_POST['fechaFinal'];
                if($configuracionDAL->ModificarConfiguracion(null, $fechaFinal, null))
                {
                    echo true;
                }                
            break;

        case "acompanantesMaximo";
                $acompanantesMax = $_POST['acompanantesMaximo'];
                if($configuracionDAL->ModificarConfiguracion(null, null, $acompanantesMax))
                {
                    echo true;
                }
            break;

        default:
            echo "Ocurrió un error...";
            break;
    }    

/////////////////////////////////////////////////////////////////////////////////////////