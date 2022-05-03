<?php
    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../Entidades/UsuarioEntidades/EntidadesUsuario.php';
    include '../../Entidades/UsuarioEntidades/EntidadesCredenciales.php';

    $UsuarioDAL = new DALUsuario();
    $CredencialesDAL = new DALCredenciales();

    $todosUsuarios = $UsuarioDAL->BuscarTodosUsuario();
    $todasCredenciales = $CredencialesDAL->BuscarTodasCredenciales();

////////////////////////////////////////////////////////////////////////////////

