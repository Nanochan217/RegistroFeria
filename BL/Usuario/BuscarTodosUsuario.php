<?php
include '../../Core/Conexion.php';
include '../../DAL/UsuarioDAL/DALUsuario.php';
include '../../DAL/UsuarioDAL/DALCredenciales.php';
include '../../DAL/UsuarioDAL/DALPerfiles.php';
include '../../Entidades/UsuarioEntidades/Usuario.php';
include '../../Entidades/UsuarioEntidades/Credenciales.php';
include '../../Entidades/UsuarioEntidades/Perfil.php';

//Funciones para buscar todos los datos relacionados a Usuarios
function BuscarUsuarios()
{
    $UsuarioDAL = new DALUsuario();
    return json_encode($UsuarioDAL->BuscarTodosUsuario());
}

function BuscarCredenciales()
{
    $CredencialesDAL = new DALCredenciales();
    return json_encode($CredencialesDAL->BuscarTodasCredenciales());
}

function BuscarPerfiles()
{
    $perfilesDAL = new DALPerfiles();
    return json_encode($perfilesDAL->BuscarTodosPerfiles());
}

////////////////////////////////////////////////////////////////////////////////
