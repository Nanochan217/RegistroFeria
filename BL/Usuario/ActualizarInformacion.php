<?php
    // session_start();
    // if(!isset($_SESSION['idUsuario']))
    //     header("Location: ../../GUI/Login/Login.php");
    //unset($_SESSION["idUsuario"]); DESTRUIR LA VARIABLE GLOBAL SESSION POR ENDE CIERRA LA SESION ACTIVA

    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';

    $cambiarCredencial = new Credenciales();
    $credencialDAL = new DALCredenciales();
    $idUsuario = $_POST['idUsuario'];
    $correoUsuario = $_POST['email'];
    $contrasenaUsuario = $_POST['contrasena'];

    $cambiarCredencial->setId($idUsuario);
    $cambiarCredencial->setCorreo($correoUsuario);
    $cambiarCredencial->setContrasena($contrasenaUsuario);

    if($credencialDAL->ActualizarCredenciales($cambiarCredencial))
    {
        CambiarInformacion();
    }
    else
        echo "<h1>MAL</h1>";
        //header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
        
    //Funcion o metodo para modificar la informacion del Usuario o sobreescribirla
    function CambiarInformacion()
    {
        $actualizarUsuario = new Usuario();
        $usuarioDAL = new DALUsuario();
        $idUsuario = $_POST['idUsuario'];

        //Captura de Datos del Usuario
        $cedulaUsuario = $_POST['cedula'];
        $nombreUsuario = $_POST['nombre'];
        $apellido1Usuario = $_POST['apellido1'];
        $apellido2Usuario = $_POST['apellido2'];
        $idPerfilUsuario = $_POST['tipoPerfil'];
        $idCredencialUsuario = $idUsuario;

        //Asignar datos a Usuario
        $actualizarUsuario->setId($idUsuario);
        $actualizarUsuario->setCedula($cedulaUsuario);
        $actualizarUsuario->setNombre($nombreUsuario);
        $actualizarUsuario->setApellido1($apellido1Usuario);
        $actualizarUsuario->setApellido2($apellido2Usuario);
        $actualizarUsuario->setIdCredenciales($idCredencialUsuario);
        $actualizarUsuario->setIdPerfil($idPerfilUsuario);

        if($usuarioDAL->ActualizarUsuario($actualizarUsuario))
        {
            header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php");
        }
        else
        {
            //header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
            echo "<h1>MAL</h1>";
        }
    }

    // if($actualizarUsuario)
    // {

    //     //OBTENCIÓN DE DATOS DESDE EL FRONT
    //     $cambiarCredencial->setId($idUsuario);
    //     $cambiarCredencial->setCorreo($correoUsuario);
    //     $cambiarCredencial->setContrasena($contrasenaUsuario);

    //     //Nueva Credencial
    //     if($credencialDAL->ActualizarCredenciales($cambiarCredencial))
    //     {
    //         //Búsqueda de la última credencial añadida
    //         $ultimaCredencial = $credencialDAL->UltimaCredencial();

    //         //Captura de Datos del Usuario
    //         $cedulaUsuario = $_POST['cedula'];
    //         $nombreUsuario = $_POST['nombre'];
    //         $apellido1Usuario = $_POST['apellido1'];
    //         $apellido2Usuario = $_POST['apellido2'];
    //         $idPerfilUsuario = $_POST['tipoPerfil'];
    //         $idCredencialUsuario = $idUsuario;

    //         //Asignar datos a Usuario
    //         $actualizarUsuario->setId($idUsuario);
    //         $nuevoUsuario->setCedula($cedulaUsuario);
    //         $nuevoUsuario->setNombre($nombreUsuario);
    //         $nuevoUsuario->setApellido1($apellido1Usuario);
    //         $nuevoUsuario->setApellido2($apellido2Usuario);
    //         $nuevoUsuario->setIdCredenciales($idCredencialUsuario);
    //         $nuevoUsuario->setIdPerfil($idPerfilUsuario);

    //         //Nuevo Usuario
    //         if($usuarioDAL->NuevoUsuario($nuevoUsuario))
    //         {
    //             header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php"); 
    //         }
    //         else
    //         {
    //             header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");                
    //         }
    //     }
    //     else
    //     {
    //         header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    //     }
    // }
    // else
    // {
    //     header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    // }



    //Busca al Usuario en la sesion para realizar validaciones
    //$usuarioSesion = $usuarioDAL->BuscarIdUsuario($idUsuarioActivo);

    //$usuarioSesion['PERFIL'] = 1 en caso de usar la busqueda por ID
    // if($_SESSION['Perfil'] = 1)
    // {
    //     //OBTENCIÓN DE DATOS DE LAS CREDENCIALES
    //     $nuevoCorreo = $_POST[''];
    //     $nuevaContrasena = $_POST[''];

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
    //     //Redireccionamiento Página Principal
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