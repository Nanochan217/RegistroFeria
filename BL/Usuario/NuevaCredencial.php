<?php
    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../Entidades/UsuarioEntidades/EntidadesCredenciales.php';

    $nuevaCredencial = new Credenciales();
    $credencialDAL = new DALCredenciales();

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
