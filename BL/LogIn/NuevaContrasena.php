<?php
    include '../../Core/Conexion.php';
    include '../../DAL/LogInDAL/DALLogIn.php';

    $recuperarCredencial = new DALLogIn();

    $correoUsuario = $_GET['key'];//Obtiene el correo de la url desde la variable key
    $nuevaContrasena1 = $_POST['newPassword1'];
    $nuevaContrasena2 = $_POST['newPassword2'];
    if($nuevaContrasena1 == $nuevaContrasena2)
    {
        if($recuperarCredencial->RestablecerContrasena($correoUsuario, $nuevaContrasena1))
        {
            echo "¡Contraseña restablecida correctamente!";
            header("Location: ../../GUI/Login/Login.php");
            exit();
        }
        else
        {
            echo "Ha ocurrido un error...";
        }
    }
    else
    {
        echo "Las contraseñas no coinciden...";
    }


