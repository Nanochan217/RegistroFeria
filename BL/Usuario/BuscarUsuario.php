<?php
include '../../Core/Conexion.php';
include '../../DAL/UsuarioDAL/DALUsuario.php';
include '../../DAL/UsuarioDAL/DALCredenciales.php';
include '../../DAL/UsuarioDAL/DALPerfiles.php';
include '../../Entidades/UsuarioEntidades/Usuario.php';
include '../../Entidades/UsuarioEntidades/Credenciales.php';
include '../../Entidades/UsuarioEntidades/Perfil.php';

//Funciones para buscar a un Usuario por ID y sus Perfiles
function BuscarIDUsuario($id)
{
    $UsuarioDAL = new DALUsuario();
    return json_encode($UsuarioDAL->BuscarIdUsuario($id));
}

function BuscarIDCredencial($id)
{
    $CredencialDal = new DALCredenciales();
    return json_encode($CredencialDal->BuscarIdCredencial($id));
}

function BuscarPerfiles()
{
    $todosPerfiles = new DALPerfiles();
    return json_encode($todosPerfiles->BuscarTodosPerfiles());
}

////////////////////////////////////////////////////////////////////////////////
