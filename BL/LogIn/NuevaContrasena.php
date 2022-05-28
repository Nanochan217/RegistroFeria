<?php
    include '../../Core/Conexion.php';
    include '../../DAL/LogInDAL/DALLogIn.php';    
    include '../../Entidades/UsuarioEntidades/Solicitudes.php';
    
    $logInDAL = new DALLogIn();

    $correoUsuario = $_POST['codigo'];
    $nuevaContrasena1 = $_POST['contrasena1'];
    $nuevaContrasena2 = $_POST['contrasena2'];    
    $correoUsuario = $logInDAL->BuscarSolicitudContrasena(null, $correoUsuario);

    switch($correoUsuario)
    {
        case "Expirado":
            echo "La solicitud de cambio de contraseña ha expirado";
            break;
        case "Denegado":
            echo "Acceso Denegado";
            break;
        default:            
            if($logInDAL->RestablecerContrasena($correoUsuario, $nuevaContrasena1))
            {
                $logInDAL->DesactivarSolicitud(null, $correoUsuario);
                echo "¡Contraseña restablecida correctamente!";            
            }
            else
            {
                echo "Ha ocurrido un error...";
            }           
            break;
    }

    // if($correoUsuario)
    // {
    //     if($nuevaContrasena1 == $nuevaContrasena2)//Hacer esta validacion a nivel de front
    //     {
    //         if($logInDAL->RestablecerContrasena($correoUsuario, $nuevaContrasena1))
    //         {
    //             echo "¡Contraseña restablecida correctamente!";            
    //         }
    //         else
    //         {
    //             echo "Ha ocurrido un error...";
    //         }
    //     }
    //     else
    //     {
    //         echo "Las contraseñas no coinciden...";
    //     }
    // }
    // else
    // {
    //     echo "No tienes acceso o ninguna solicitud de cambio de contraseña activa";
    // }

///////////////////////////////////////////////////////////////////////////////////////////