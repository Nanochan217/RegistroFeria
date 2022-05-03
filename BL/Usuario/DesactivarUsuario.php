<?php
    if(!isset($_SESSION['IDUSUARIO']))
        header("Location: ./");
    //unset($_SESSION["idUsuario"]);

    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../Entidades/UsuarioEntidades/EntidadesUsuario.php';
    include '../../Entidades/UsuarioEntidades/EntidadesCredenciales.php';

    $desactivarUsuario = new Usuario();
    $desactivarCredencial = new Credenciales();
    $usuarioDAL = new DALUsuario();
    $credencialDAL = new DALCredenciales();
    $idUsuarioActivo = $_SESSION['IDUSUARIO'];//Se obtiene la ID del Usuario Activo

    //Busca al Usuario en la sesion para realizar validaciones
    $usuarioSesion = $usuarioDAL->BuscarIdUsuario($idUsuarioActivo);

    //Se valida al usuario en sesión si es SuperAdmin
    if($usuarioSesion['PERFIL'] = 1)
    {
        //OBTENCIÓN DEL ID DEL USUARIO A DESACTIVAR
        $idUsuario = $_POST[''];

        //ASIGNACION DE LAS NUEVAS CREDENCIALES
        $desactivarCredencial->setId($idUsuarioActivo);
        $desactivarCredencial->setActive(0);
        $desactivarUsuario->setId($idUsuarioActivo);
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
        //Redireccionamiento Página Principal
    }
