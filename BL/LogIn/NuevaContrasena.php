<?php
    include '../../Core/Conexion.php';
    include '../../DAL/LogInDAL/DALLogIn.php';    
    include '../../Entidades/UsuarioEntidades/Solicitudes.php';
    
    $logInDAL = new DALLogIn();

    $correoUsuario = $_GET['email'];
    $nuevaContrasena1 = $_POST['contrasena1'];
    $nuevaContrasena2 = $_POST['contrasena2'];    
    $correoUsuario = $logInDAL->BuscarSolicitudContrasena(null, $correoUsuario);

    if($nuevaContrasena1 == $nuevaContrasena2)
    {
        switch($correoUsuario)
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
                if($logInDAL->RestablecerContrasena($correoUsuario, $nuevaContrasena1))
                {
                    if($logInDAL->DesactivarSolicitud(null, $correoUsuario))
                        echo "¡Contraseña restablecida correctamente!";            
                }
                else
                {
                    echo "Ha ocurrido un error...";
                }           
                break;
        }
    }
    else
    {
        echo "¡Las contraseñas no coinciden!";
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