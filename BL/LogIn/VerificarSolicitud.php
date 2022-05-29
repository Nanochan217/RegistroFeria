<?php
    //EN PROCESO...
    //VER SI DE INCRUSTA EN NUEVA CONTRASENA DIRECTAMENTE
    include '../../Core/Conexion.php';
    include '../../DAL/LogInDAL/DALLogIn.php';    
    include '../../Entidades/UsuarioEntidades/Solicitudes.php';        

    $logInDAL = new DALLogIn();
    $codigoSolicitud = $_GET['cod'];
    $estado = $logInDAL->BuscarSolicitudContrasena($codigoSolicitud, null);

    switch($estado)
    {
        case "Expirado":
            //La solicitud de cambio de contraseña ha expirado
            header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");            
            break;
        case "Denegado":
            //Acceso Denegado
            header("Location: ../../GUI/PantallasDestino/AccesoDenegado.php");
            break;
        default:
            header("Location: ../../BL/LogIn/NuevaContrasena.php?email=".$estado);
            break;
    }    

    