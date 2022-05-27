<?php
    include '../../Core/Conexion.php';
    include '../../DAL/LogInDAL/DALLogIn.php';

    //EN PROCESO DE DESARROLLO...

    $logInDAL = new DALLogIn();
    $correoUsuario = $_POST['correoRecovery'];
    
    if($logInDAL->VerificarCorreoUsuario($correoUsuario))
    {
        echo "¡Correo Enviado a ".$correoUsuario."!<br>
        Verifica tu bandeja de entrada o de spam y sigue los pasos indicados en el";
    }
    else
    {
        echo "El correo: ".$correoUsuario." no está registrado en nuestro Sistema";
    }

///////////////////////////////////////////////////////////////////////////////////////////