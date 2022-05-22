<?php
    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/LogInDAL/DALLogIn.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';   
        
    $confirmarSesion = new Credenciales();
    $UsuarioDAL = new DALUsuario();
    $CredencialesDAL = new DALLogIn();

    //Obtencion por medio de POST tanto el Correo como Contraseña ingresados
    $correoUsuario = $_POST['usuario'];
    $contrasena = $_POST['password'];
    
    //Objeto de Nueva Sesion para el DAL de Sesion
    $confirmarSesion->setId(null);
    $confirmarSesion->setCorreo($correoUsuario);
    $confirmarSesion->setContrasena($contrasena);
    $confirmarSesion->setActive(1);

    $estadoSesion = $CredencialesDAL->NuevaSesionUsuario($confirmarSesion);
    if(isset($estadoSesion))
    {
        $id = $estadoSesion->getId();
        $nuevaSesionUsuario = $UsuarioDAL->BuscarSesionUsuario($id);
        $perfilUsuario = $nuevaSesionUsuario->getIdPerfil();
        
        if($perfilUsuario == 1)
        {
            RestaurarSesion();
//                if(!isset($_SESSION))
//                    unset($_SESSION);                
//                session_start();
            $_SESSION["idUsuario"] = $nuevaSesionUsuario->getId();
            $_SESSION["Perfil"] = $perfilUsuario;
            header("Location: ../../GUI/Index/Index.php");
        }
        
        if($perfilUsuario == 2)
        {
            RestaurarSesion();
//                if(!isset($_SESSION))
//                    unset($_SESSION);                
//                session_start();                
            $_SESSION["idUsuario"] = $nuevaSesionUsuario->getId();
            $_SESSION["Perfil"] = $perfilUsuario;
            header("Location: ../../GUI/Index/Index.php");
        }
        
        if($perfilUsuario == 3)
        {
            RestaurarSesion();
//                if(!isset($_SESSION))
//                    unset($_SESSION);
//                session_start();
            $_SESSION["idUsuario"] = $nuevaSesionUsuario->getId();
            $_SESSION["Perfil"] = $perfilUsuario;
            header("Location: ../../GUI/Index/Index.php");
        }        
    }
    else
    {
        echo "Los datos que ha ingresado son incorrectos";
        header("Location: ../../GUI/Login/Login.php");
    }

    function RestaurarSesion()
    {
        if(!isset($_SESSION))
            unset($_SESSION);
        return session_start();
    }
    
////////////////////////////////////////////////////////////////////////////////


