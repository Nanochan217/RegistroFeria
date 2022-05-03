<?php
    include '../Core/Conexion.php';
    include '../DAL/UsuarioDAL/DALUsuario.php';
    include '../Entidades/UsuarioEntidades/EntidadesCredenciales.php';

    $nuevaCredencial = new Credenciales();//Entidades de las Credenciales
    $credencialDAL = new DALCredenciales();//Métodos del Usuario

    //OBTENCIÓN DE DATOS DESDE EL FRONT
    $nuevaCredencial->setCorreo($_POST['']);
    $nuevaCredencial->getContrasena($_POST['']);

    //Nueva Credencial
    if($credencialDAL->NuevaCredencial($nuevaCredencial))
    {
        //Redireccionamiento
    }
    else
    {
        //Redireccionamiento
    }
//////////////////////////////////////////////////////////////
