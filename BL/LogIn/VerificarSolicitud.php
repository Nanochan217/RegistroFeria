<?php
    //EN PROCESO...
    //VER SI DE INCRUSTA EN NUEVA CONTRASENA DIRECTAMENTE
    include '../../Core/Conexion.php';
    include '../../DAL/LogInDAL/DALLogIn.php';    
    include '../../Entidades/UsuarioEntidades/Solicitudes.php';        

    $logInDAL = new DALLogIn();
    $codigoSolicitud = $_GET['codigo'];

    if($logInDAL->BuscarSolicitudContrasena($codigoSolicitud))
    {
        $correo = "";
        header("Location: ../../BL/LogIn/NuevaContrasena.php?estado='".crypt($correo, 'rl')."'");
    }