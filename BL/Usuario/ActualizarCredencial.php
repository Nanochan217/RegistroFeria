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
    $idUsuarioActivo = $_POST['idUsuario'];


    if($_SESSION['idUsuario'] == $idUsuarioActivo)
    {
        //OBTENCIÓN DE DATOS DE LAS CREDENCIALES
        $correo = $_POST['email'];
        $contrasena = $_POST['contrasena'];

        //ASIGNACION DE LAS NUEVAS CREDENCIALES
        $cambiarCredencial->setId($idUsuarioActivo);
        $cambiarCredencial->setCorreo($correo);
        $cambiarCredencial->setContrasena($contrasena);

        //Aplicar Cambios a las Credenciales y Usuarios
        if($credencialDAL->ActualizarCredenciales($cambiarCredencial))
        {
            header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php");
        }
        else
        {
            header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
        }
    }
    else
    {
        echo "<h1>ESTAS MODIFICANDO DATOS DE OTRA PERSONA, NO TIENES AUTORIZACION</h1>";
        //header("Location: ../../GUI/Index/Index.php");
    }
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