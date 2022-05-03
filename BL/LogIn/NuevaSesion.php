<?php
    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/LogInDAL/DALLogIn.php';
    include '../../Entidades/UsuarioEntidades/EntidadesCredenciales.php';

    $confirmarSesion = new Credenciales();
    $UsuarioDAL = new DALUsuario();
    $CredencialesDAL = new DALLogIn();

    $correo = $_POST['correo'];
    $contrasena = $_POST['password'];
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
            $_SESSION['Perfil'] = 1;
        }
        else if($nuevaSesionUsuario->getIdPerfil()==2)
        {
            //Admin
            session_start();
            $_SESSION['idUsuario'] = $nuevaSesionUsuario->getId();
            $_SESSION['Perfil'] = 2;
        }
        else
        {
            session_start();
            $_SESSION['idUsuario'] = $nuevaSesionUsuario->getId();
            $_SESSION['Perfil'] = 3;
        }
    }
    else
    {
        //Redireccionamiento en caso de que no se inicie la sesión
    }

////////////////////////////////////////////////////////////////////////////////


