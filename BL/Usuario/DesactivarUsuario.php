<?php
    session_start();
    if($_SESSION['Perfil'] != 1)
        header("Location: ../../GUI/PantallasDestino/AccesoDenegado.php");

    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';
    
    $usuarioDAL = new DALUsuario();
    $credencialDAL = new DALCredenciales();
    $idUsuario = $_POST['id'];    

    //Se valida al usuario en sesión si es SuperAdmin
    if($_SESSION['Perfil'] == 1)
    {        
        if($credencialDAL->DesactivarCredencial($idUsuario) && $usuarioDAL->DesactivarUsuario($idUsuario))
        {
            echo "¡El Usuario ha sido eliminado correctamente!";
        }
        else
        {
            echo "Ocurrió un Error, intentelo nuevamente";
        }
    }
    else
    {
        header("Location: ../../GUI/PantallasDestino/AccesoDenegado.php");
    }
