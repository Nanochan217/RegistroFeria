<?php
    include '../../Core/Conexion.php';
    include '../../DAL/LogInDAL/DALLogIn.php';

    $recuperarCredencial = new DALLogIn();

    $nuevaContrasena1 = $_POST['contrasena1'];
    $nuevaContrasena2 = $_POST['contrasena2'];

    if($nuevaContrasena1 == $nuevaContrasena2)
    {
        if($recuperarCredencial->RestablecerContrasena($correoUsuario, $nuevaContrasena1))
        {
            echo "¡Contraseña restablecida correctamente!";            
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


