<?php
    include '../../Core/Conexion.php';
    include '../../DAL/LogInDAL/DALLogIn.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../Entidades/UsuarioEntidades/Solicitudes.php';    
    include '../../Entidades/UsuarioEntidades/Usuario.php';
    //EN PROCESO DE DESARROLLO...
    date_default_timezone_set("America/Costa_Rica");
    $fechaExp = new DateTime();
    $fechaExp->modify('+30 minute');
    $fechaActual = date('d-m-y H:i:s');
    $fechaExpiracion = $fechaExp->format('d-m-y H:i:s');

    $solicitud = new Solicitudes();
    $usuarioDAL = new DALUsuario();
    $logInDAL = new DALLogIn();
    $correoUsuario = $_POST['correoRecovery'];

    $solicitud->setCorreoUsuario($correoUsuario);
    $solicitud->setFechaSolicitud($fechaActual);
    $solicitud->setFechaExpiracion($fechaExpiracion);
    $solicitud->setCodigoSolicitud($correoUsuario);
               
    if(!$usuarioDAL->BuscarCorreo($correoUsuario))
    {
        if($logInDAL->CorreoRestablecerContrasena($solicitud))
        {
            $logInDAL->NuevaSolicitudContrasena($solicitud);
            echo "¡Correo Enviado a ".$correoUsuario."!<br>
            Verifica tu bandeja de entrada o de spam y sigue los pasos indicados en el";
        }        
    }
    else
    {
        echo "El correo: ".$correoUsuario." no está registrado en nuestro Sistema";
    }

    //NUEVA TABLA
    // CREATE TABLE SolicitudNuevaContrasena(
    //     id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    //     correoUsuario VARCHAR(200) NOT NULL,
    //     fechaSolicitud DATE NOT NULL,
    //     fechaExpiracion DATE NOT NULL,
    //     codigoSolicitud VARCHAR(200) NOT NULL,
    //     active BOOLEAN NOT NULL
    // );


    // $pass = 'norlanalguera@gmail.com';
    // $hashString = crypt($pass, 'rl');
    // echo "Identificador Unico: '".$hashString."' Fecha Actual: ".$fechaActual." Fecha Exp: ".$fechaExp->format('d-m-y H:i:s');

    // if(password_verify("norlanalguera@gmail.com", $hashString))
    // {
    //     echo "<br>Coinciden!!!";
    // }
    // else
    // {
    //     echo "<br>No coinciden...";
    // } 
///////////////////////////////////////////////////////////////////////////////////////////