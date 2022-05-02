<?php
    include '../Core/Conexion.php';
    include '../DAL/DALUsuario.php';
    include '../Entidades/UsuarioEntidades/EntidadesUsuario.php';
    include '../Entidades/UsuarioEntidades/EntidadesCredenciales.php';
    include '../Entidades/UsuarioEntidades/EntidadesPerfil.php';

    $nuevoUsuario = new Usuario();//Entidades del Usuario
    $nuevaCredencial = new Credenciales();//Entidades de las Credenciales
    $usuarioDAL = new DALUsuario();//Métodos del Usuario

    //OBTENCIÓN DE DATOS DESDE EL FRONT
    $nuevaCredencial->setCorreo($_POST['']);
    $nuevaCredencial->getContrasena($_POST['']);

    //Nueva Credencial
    $usuarioDAL->NuevaCredencial($nuevaCredencial);
    $idNuevaCredencial = $usuarioDAL->AsignarCredencial();
    //Nuevo Usuario
    $cedulaUsuario = $_POST[''];
    $nombreUsuario = $_POST[''];
    $apellido1Usuario = $_POST[''];
    $apellido2Usuario = $_POST[''];
    $idPerfilUsuario = $_POST[''];
    $idCredencial = $idNuevaCredencial['ID'];

    $nuevoUsuario->setCedula($cedulaUsuario);
    $nuevoUsuario->setNombre($nombreUsuario);
    $nuevoUsuario->setApellido1($apellido1Usuario);
    $nuevoUsuario->setApellido2($apellido2Usuario);
    $nuevoUsuario->setIdCredenciales($idCredencial);
    $nuevoUsuario->setIdPerfil($idPerfilUsuario);

    if($usuarioDAL->NuevoUsuario($nuevoUsuario))
    {
        //Redireccionamiento
    }
    else
    {
        //Redireccionamiento
    }

