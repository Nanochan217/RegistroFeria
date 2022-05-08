<?php
    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';

    $CredencialesDAL = new DALCredenciales();
    
    function BuscarID ($id){
        $UsuarioDAL = new DALUsuario();
        return json_encode($UsuarioDAL->BuscarIdUsuario($id));
    }

    //$buscarCredencial = $CredencialesDAL->BuscarIdCredencial($id);

////////////////////////////////////////////////////////////////////////////////

