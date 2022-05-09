<?php
    include '../../Core/Conexion.php';
    include '../../DAL/LogInDAL/DALLogIn.php';

    $logInDAL = new DALLogIn();
    $correoUsuario = $_POST['correoRecovery'];
    
    if($logInDAL->VerificarCorreoUsuario($correoUsuario))
    {
        echo "<h1>¡Correo Enviado!</h1>";
    }
    else
    {
        echo "<h1>El correo no existe en el Sistema</h1>";
        //header("Location: ../../GUI/Login/Login.php");
    }


