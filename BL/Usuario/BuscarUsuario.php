<?php
    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';

    $CredencialesDAL = new DALCredenciales();
    
    function BuscarIDUsuario ($id){
        $UsuarioDAL = new DALUsuario();
        return json_encode($UsuarioDAL->BuscarIdUsuario($id));
    }

    function BuscarIDCredencial($id)
    {
        $CredencialDal = new DALCredenciales();
        return json_encode($CredencialDal->BuscarIdCredencial($id));
    }

    //$buscarCredencial = $CredencialesDAL->BuscarIdCredencial($id);

////////////////////////////////////////////////////////////////////////////////

