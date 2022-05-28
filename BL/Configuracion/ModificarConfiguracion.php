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
                if(!$estadoConfiguracion)
                {                    
                    if($configuracionDAL->DisponibilidadConfiguracion(null))
                    {
                        echo true;
                    }
                }
                else if($estadoConfiguracion)
                {
                    if($configuracionDAL->DisponibilidadConfiguracion(true))
                    {
                        echo true;
                    }
                }
            break;

        case "fechaInicial";
                $fechaInicial = $_POST['fechaInicial'];
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

        // case "fechaFinal";
        //         $fechaFinal = $_POST['fechaFinal'];
        //         $configuracionDAL->ModificarConfiguracion(null, $fechaFinal, null);
        //     break;

        default:
            echo "Ocurrió un error...";
            break;
    }    

/////////////////////////////////////////////////////////////////////////////////////////