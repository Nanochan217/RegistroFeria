<?php

    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/LogInDAL/DALLogIn.php';
    include '../../Entidades/UsuarioEntidades/EntidadesCredenciales.php';

    $confirmarSesion = new Credenciales();
    $UsuarioDAL = new DALUsuario();
    $CredencialesDAL = new DALLogIn();

    $correo = $_POST[''];
    $contrasena = $_POST[''];
    $confirmarSesion->setCorreo($correo);
    $confirmarSesion->setContrasena($contrasena);

    $estadoSesion = $CredencialesDAL->NuevaSesionUsuario($confirmarSesion);
    if(!isset($estadoSesion))
    {
        $nuevaSesionUsuario = $UsuarioDAL->BuscarIdUsuario($estadoSesion->getId());
        if($nuevaSesionUsuario->getIdPerfil()==1)
        {
            //SuperAdmin
            session_start();
            $_SESSION['idUsuario'] = $nuevaSesionUsuario->getId();
            $_SESSION['Perfil'] = "SuperAdmin";
        }
        else if($nuevaSesionUsuario->getIdPerfil()==2)
        {
            //Admin
            session_start();
            $_SESSION['idUsuario'] = $nuevaSesionUsuario->getId();
            $_SESSION['Perfil'] = "Admin";
        }
        else
        {
            session_start();
            $_SESSION['idUsuario'] = $nuevaSesionUsuario->getId();
            $_SESSION['Perfil'] = "Guarda";
        }
    }
    else
    {
        //Redireccionamiento en caso de que no se inicie la sesión
    }

////////////////////////////////////////////////////////////////////////////////


