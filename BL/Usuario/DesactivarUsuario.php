<?php
    if(!isset($_SESSION['idUsuario']))
        header("Location: ../../GUI/Index/Index.php");

    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';

    $desactivarUsuario = new Usuario();
    $desactivarCredencial = new Credenciales();
    $usuarioDAL = new DALUsuario();
    $credencialDAL = new DALCredenciales();
    $idUsuarioActivo = $_SESSION['idUsuario'];//Se obtiene la ID del Usuario Activo

    //Busca al Usuario en la sesion para realizar validaciones
    //$usuarioSesion = $usuarioDAL->BuscarIdUsuario($idUsuarioActivo);
    //$usuarioSesion['PERFIL'] = 1 en caso de usar la busqueda de usuarios

    //Se valida al usuario en sesión si es SuperAdmin
    if($_SESSION['Perfil'] = 1)
    {
        //OBTENCIÓN DEL ID DEL USUARIO A DESACTIVAR
        $idUsuario = $_POST[''];

        //ASIGNACION DE LAS NUEVAS CREDENCIALES
        $desactivarCredencial->setId($idUsuario);
        $desactivarCredencial->setActive(0);
        $desactivarUsuario->setId($idUsuario);
        $desactivarUsuario->setActive(0);

        //Aplicar Cambios a las Credenciales y Usuarios
        if($credencialDAL->DesactivarCredencial($desactivarCredencial) && $usuarioDAL->DesactivarUsuario($desactivarUsuario))
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
        header("Location: ../../GUI/Index/Index.php");
    }
