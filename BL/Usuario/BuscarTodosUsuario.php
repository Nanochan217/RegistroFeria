<?php
    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../DAL/UsuarioDAL/DALPerfiles.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';
    include '../../Entidades/UsuarioEntidades/Perfil.php';

    $UsuarioDAL = new DALUsuario();
    $CredencialesDAL = new DALCredenciales();
    $perfilesDAL = new DALPerfiles();

    $todosUsuarios = $UsuarioDAL->BuscarTodosUsuario();
    $todasCredenciales = $CredencialesDAL->BuscarTodasCredenciales();
    $todosPerfiles = $perfilesDAL->BuscarTodosPerfiles();
////////////////////////////////////////////////////////////////////////////////

