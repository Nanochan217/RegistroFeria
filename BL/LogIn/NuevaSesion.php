<?php
    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/LogInDAL/DALLogIn.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';

    $correoUsuario = $_POST['usuario'];
    $contrasena = $_POST['password'];

    $confirmarSesion = new Credenciales();
    $UsuarioDAL = new DALUsuario();
    $CredencialesDAL = new DALLogIn();

    $confirmarSesion->setId(null);
    $confirmarSesion->setCorreo($correoUsuario);
    $confirmarSesion->setContrasena($contrasena);
    $confirmarSesion->setActive(1);

    $estadoSesion = $CredencialesDAL->NuevaSesionUsuario($confirmarSesion);
    if(isset($estadoSesion))
    {
        if($nuevaSesionUsuario = $UsuarioDAL->BuscarIdUsuario($estadoSesion->getId()))
        {
            if($nuevaSesionUsuario->getIdPerfil()==1)
            {
                if(!isset($_SESSION))
                    unset($_SESSION);
                //SuperAdmin
                session_start();
                $_SESSION["idUsuario"] = $nuevaSesionUsuario->getId();
                $_SESSION["Perfil"] = 1;
                header("Location: ../../GUI/Index/Index.php");
            }
            else if($nuevaSesionUsuario->getIdPerfil()==2)
            {
                if(!isset($_SESSION))
                    unset($_SESSION);
                //Admin
                session_start();
                $_SESSION["idUsuario"] = $nuevaSesionUsuario->getId();
                $_SESSION["Perfil"] = 2;
                header("Location: ../../GUI/Index/Index.php");
            }
            else
            {
                if(!isset($_SESSION))
                    unset($_SESSION);
                session_start();
                $_SESSION["idUsuario"] = $nuevaSesionUsuario->getId();
                $_SESSION["Perfil"] = 3;
                header("Location: ../../GUI/Index/Index.php");
            }
        }
    }
    else
    {
        echo "Los datos que ha ingresado son incorrectos";
        header("Location: ../../GUI/Login/Login.php");
    }

////////////////////////////////////////////////////////////////////////////////


