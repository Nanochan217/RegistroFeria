<?php
    session_start();
    if(!isset($_SESSION['idUsuario']))
        header("Location: ../../GUI/Index/Index.php");
    //unset($_SESSION["idUsuario"]); DESTRUIR LA VARIABLE GLOBAL SESSION POR ENDE CIERRA LA SESION ACTIVA

    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';

    $actualizarUsuario = new Usuario();
    $cambiarCredencial = new Credenciales();
    $usuarioDAL = new DALUsuario();
    $credencialDAL = new DALCredenciales();
    $idUsuarioActivo = $_SESSION['idUsuario'];

    echo "<h1>'".$idUsuarioActivo."'</h1>";
    //Busca al Usuario en la sesion para realizar validaciones
    //$usuarioSesion = $usuarioDAL->BuscarIdUsuario($idUsuarioActivo);

    //$usuarioSesion['Perfil'] = 1 en caso de usar la busqueda por ID
    // if($_SESSION['Perfil'] = 1)
    // {
    //     //OBTENCIÓN DE DATOS DE LAS CREDENCIALES
    //     $nuevoCorreo = $_POST['email'];
    //     $nuevaContrasena = $_POST['contrasena'];

    //     //ASIGNACION DE LAS NUEVAS CREDENCIALES
    //     $cambiarCredencial->setId($idUsuarioActivo);
    //     $cambiarCredencial->setCorreo($nuevoCorreo);
    //     $cambiarCredencial->setContrasena($nuevaContrasena);

    //     //Aplicar Cambios a las Credenciales y Usuarios
    //     if($credencialDAL->ActualizarCredenciales($cambiarCredencial))
    //     {
    //         //Redireccionamiento o Return
    //     }
    //     else
    //     {
    //         //Redireccionamiento o Return
    //     }
    // }
    // else
    // {
    //     header("Location: ../../GUI/Index/Index.php");
    // }
/////////////////////////////////////////////////////////////////////////////////

//Nuevos Datos del Usuario
//$nuevaCedulaUsuario = $_POST[''];
//$nuevoNombreUsuario = $_POST[''];
//$nuevoApellido1Usuario = $_POST[''];
//$nuevoApellido2Usuario = $_POST[''];
//$idPerfilUsuario = $_POST[''];

//Asignando Nuevos Datos del Usuario
//$actualizarUsuario->setId($idUsuarioActivo);
//$actualizarUsuario->setCedula($nuevaCedulaUsuario);
//$actualizarUsuario->setNombre($nuevoNombreUsuario);
//$actualizarUsuario->setApellido1($nuevoApellido1Usuario);
//$actualizarUsuario->setApellido2($nuevoApellido2Usuario);
//$actualizarUsuario->setIdCredenciales($idUsuarioActivo);
//$actualizarUsuario->setIdPerfil($idPerfilUsuario);