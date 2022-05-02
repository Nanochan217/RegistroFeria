<?php
    include '../Core/Conexion.php';
    include '../DAL/UsuarioDAL/DALUsuario.php';
    include '../DAL/UsuarioDAL/DALCredenciales.php';
    include '../Entidades/UsuarioEntidades/EntidadesUsuario.php';
    include '../Entidades/UsuarioEntidades/EntidadesCredenciales.php';

    $actualizarUsuario = new Usuario();//Entidades del Usuario
    $cambiarCredencial = new Credenciales();//Entidades de las Credenciales
    $usuarioDAL = new DALUsuario();//Métodos del Usuario
    $credencialDAL = new DALCredenciales();//Métodos de las Credenciales

    //OBTENCIÓN DE DATOS DESDE EL FRONT
    $nuevoCorreo = $_POST[''];
    $nuevaContrasena = $_POST[''];
    $cambiarCredencial->setCorreo($nuevoCorreo);
    $cambiarCredencial->setContrasena($nuevaContrasena);

    //SEGUIR CON LA MODIFICACION DE USUARIOS

    //Cambiar Credenciales
    if($credencialDAL->ActualizarCredenciales($cambiarCredencial))
    {
        //Mensaje
        //$idCredencial = $credencialDAL->BuscarCredencial();
        ////Busca la Credencial (OJO)
    }
    else
    {
        //Mensaje
    }

    //Nuevos Datos del Usuario
    $nuevaCedulaUsuario = $_POST[''];
    $nuevoNombreUsuario = $_POST[''];
    $nuevoApellido1Usuario = $_POST[''];
    $nuevoApellido2Usuario = $_POST[''];
    $idPerfilUsuario = $_POST[''];
    //$idCredencial = $idCredencial['ID']; OPCIONAL YA QUE MANTIENE LA MISMA ID
    $estadoUsuario = $_POST[''];

    //Asignando Nuevos Datos del Usuario
    $actualizarUsuario->setCedula($nuevaCedulaUsuario);
    $actualizarUsuario->setNombre($nuevoNombreUsuario);
    $actualizarUsuario->setApellido1($nuevoApellido1Usuario);
    $actualizarUsuario->setApellido2($nuevoApellido2Usuario);
    //$actualizarUsuario->setIdCredenciales($idCredencial);
    $actualizarUsuario->setIdPerfil($idPerfilUsuario);
    $actualizarUsuario->setActive($estadoUsuario);

    //Modificando Datos del Usuario
    if($usuarioDAL->ActualizarUsuario($actualizarUsuario))
    {
        //Redireccionamiento
    }
    else
    {
        //Redireccionamiento
    }