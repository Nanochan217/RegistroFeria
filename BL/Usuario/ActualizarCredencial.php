<?php
    if(!isset($_SESSION['IDUSUARIO']))
        header("Location: ./");
    //unset($_SESSION["idUsuario"]); DESTRUIR LA VARIABLE GLOBAL SESSION POR ENDE CIERRA LA SESION ACTIVA

    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../Entidades/UsuarioEntidades/EntidadesUsuario.php';
    include '../../Entidades/UsuarioEntidades/EntidadesCredenciales.php';

    $actualizarUsuario = new Usuario();
    $cambiarCredencial = new Credenciales();
    $usuarioDAL = new DALUsuario();
    $credencialDAL = new DALCredenciales();
    $idUsuarioActivo = $_SESSION['IDUSUARIO'];

    //Busca al Usuario en la sesion para realizar validaciones
    $usuarioSesion = $usuarioDAL->BuscarIdUsuario($idUsuarioActivo);

    if($usuarioSesion['PERFIL'] = 1)
    {
        //OBTENCIÓN DE DATOS DE LAS CREDENCIALES
        $nuevoCorreo = $_POST[''];
        $nuevaContrasena = $_POST[''];

        //ASIGNACION DE LAS NUEVAS CREDENCIALES
        $cambiarCredencial->setId($idUsuarioActivo);
        $cambiarCredencial->setCorreo($nuevoCorreo);
        $cambiarCredencial->setContrasena($nuevaContrasena);

        //Aplicar Cambios a las Credenciales y Usuarios
        if($credencialDAL->ActualizarCredenciales($cambiarCredencial))
        {
            //Redireccionamiento o Return
        }
        else
        {
            //Redireccionamiento o Return
        }
    }
    else
    {
        //Redireccionamiento Página Principal
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