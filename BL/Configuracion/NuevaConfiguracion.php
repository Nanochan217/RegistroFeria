<?php
    session_start();
    //if(!isset($_SESSION['IDUSUARIO']=$usuario->getId()))Asignar el valor de la ID a la sesion
    //header("Location: ./");

    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../Entidades/UsuarioEntidades/EntidadesUsuario.php';
    include '../../Entidades/UsuarioEntidades/EntidadesCredenciales.php';
    include '../../Entidades/UsuarioEntidades/EntidadesPerfil.php';
