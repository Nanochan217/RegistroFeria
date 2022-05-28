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
            echo "E";            
            break;
        case "Denegado":
            //Acceso Denegado
            echo "A";            
            break;
        default:
            echo $estado;//Devuelve el correo al JS (PREGUNTAR A BRYAN SI HAY UNA MANERA DE)
            //SACAR ESTO DESDE EL JS
            break;
    }

    // if()
    // {        
    //     // $correo = "";
    //     // header("Location: ../../BL/LogIn/NuevaContrasena.php?estado='".crypt($correo, 'rl')."'");
    // }