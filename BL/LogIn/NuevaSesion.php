<?php
    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/LogInDAL/DALLogIn.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';   
        
    $accion = "";
    $confirmarSesion = new Credenciales();
    $UsuarioDAL = new DALUsuario();
    $CredencialesDAL = new DALLogIn();

    //Obtencion por medio de POST tanto el Correo como Contraseña ingresados
    $correoUsuario = $_POST['correoPost'];
    $contrasena = $_POST['contrasenaPost'];
    
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
            $_SESSION["idUsuario"] = $nuevaSesionUsuario->getId();
            $_SESSION["Perfil"] = $perfilUsuario;
            echo $accion;
        }        
        else if($perfilUsuario == 2)
        {
            RestaurarSesion();               
            $_SESSION["idUsuario"] = $nuevaSesionUsuario->getId();
            $_SESSION["Perfil"] = $perfilUsuario;
            echo $accion;
        }        
        else
        {
            RestaurarSesion();
            $_SESSION["idUsuario"] = $nuevaSesionUsuario->getId();
            $_SESSION["Perfil"] = $perfilUsuario;
            echo $accion;
        }        
    }
    else
    {
        $accion = "Correo y/o Contraseña incorrectos <br> Intentelo nuevamente";
        echo $accion;
        //header("Location: ../../GUI/Login/Login.php");
    }

    function RestaurarSesion()
    {
        if(!isset($_SESSION))
            unset($_SESSION);
        return session_start();
    }
    
////////////////////////////////////////////////////////////////////////////////


