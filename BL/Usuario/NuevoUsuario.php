<?php
    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';

    $nuevoUsuario = new Usuario();
    $usuarioDAL = new DALUsuario();

    $nuevaCredencial = new Credenciales();
    $credencialDAL = new DALCredenciales();

    $correoUsuario = $_POST['correo'];
    $contrasenaUsuario = $_POST['password'];

    //OBTENCIÓN DE DATOS DESDE EL FRONT
    $nuevaCredencial->setCorreo($correoUsuario);
    $nuevaCredencial->setContrasena($contrasenaUsuario);

    //Nueva Credencial
    if($credencialDAL->NuevaCredencial($nuevaCredencial))
    {
        //Búsqueda de la última credencial añadida
        $ultimaCredencial = $credencialDAL->UltimaCredencial();

        //Captura de Datos del Usuario
        $cedulaUsuario = $_POST['cedula'];
        $nombreUsuario = $_POST['nombre'];
        $apellido1Usuario = $_POST['apellido1'];
        $apellido2Usuario = $_POST['apellido2'];
        $idPerfilUsuario = $_POST['perfil'];
        $idCredencialUsuario = $ultimaCredencial->getId();

        //Asignar datos a Usuario
        $nuevoUsuario->setCedula($cedulaUsuario);
        $nuevoUsuario->setNombre($nombreUsuario);
        $nuevoUsuario->setApellido1($apellido1Usuario);
        $nuevoUsuario->setApellido2($apellido2Usuario);
        $nuevoUsuario->setIdCredenciales($idCredencialUsuario);
        $nuevoUsuario->setIdPerfil($idPerfilUsuario);

        //Nuevo Usuario
        if($usuarioDAL->NuevoUsuario($nuevoUsuario))
        {
            header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php");            
        }
        else
        {
            header("Location: ../../GUI/Index/Index.php");
        }
    }
    else
    {
        header("Location: ../../GUI/Index/Index.php");
    }

    

    
/////////////////////////////////////////////////////////////////////////////