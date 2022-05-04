<?php
    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';

    $nuevoUsuario = new Usuario();
    $usuarioDAL = new DALUsuario();
    $usuarioCredencial = new DALCredenciales();

    //Búsqueda de la última credencial añadida (may affect)
    $ultimaCredencial = $usuarioCredencial->UltimaCredencial();

    //Captura de Datos del Usuario
    $cedulaUsuario = $_POST[''];
    $nombreUsuario = $_POST[''];
    $apellido1Usuario = $_POST[''];
    $apellido2Usuario = $_POST[''];
    $idPerfilUsuario = $_POST[''];
    $idCredencialUsuario = $ultimaCredencial['ID'];

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
        //Redireccionamiento
    }
    else
    {
        //Redireccionamiento
    }
/////////////////////////////////////////////////////////////////////////////