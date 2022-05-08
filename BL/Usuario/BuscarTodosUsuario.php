<?php
    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../DAL/UsuarioDAL/DALPerfiles.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';
    include '../../Entidades/UsuarioEntidades/Perfil.php';

    $UsuarioDAL = new DALUsuario();
    $CredencialesDAL = new DALCredenciales();
    $perfilesDAL = new DALPerfiles();

//Arrays con la información de todos los Usuarios Administrativos
    $todosUsuarios = $UsuarioDAL->BuscarTodosUsuario();
    $todasCredenciales = $CredencialesDAL->BuscarTodasCredenciales();
    $todosPerfiles = $perfilesDAL->BuscarTodosPerfiles();

//Convierte el Array de Todos los Usuarios (OJO que solo usuarios)
//echo $todosUsuarios;

    // foreach ($todosUsuarios as $t) {
    //     $t = json_encode($t);
    // }

    // for ($i=0; $i < count($todosUsuarios); $i++) {
    //     $todosUsuarios[$i] = json_encode($todosUsuarios[$i]);
    // }
    
    //ERAN PRUEBAS!!!
    //JSON para la parte de JS (EN PROCESO...)
    //$jsonUsuarios = json_encode($todosUsuarios);
    // $jsonCredenciales = json_encode($todasCredenciales);
    // $jsonPerfiles = json_encode($todosPerfiles);

    // echo $jsonCredenciales;
    // echo $jsonPerfiles;
////////////////////////////////////////////////////////////////////////////////


