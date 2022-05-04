<?php
    include '../../Core/Conexion.php';
    include '../../DAL/LogInDAL/DALLogIn.php';

    $verificarCredencial = new DALLogIn();
    $correoUsuario = $_POST['correoRecovery'];

    if($verificarCredencial->VerificarCorreoUsuario($correoUsuario))
    {
        echo "¡Correo Enviado!";
    }
    else
    {
        echo "El correo no existe en el Sistema";
    }


