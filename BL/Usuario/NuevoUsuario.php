<?php
    session_start();
    if($_SESSION['Perfil'] != 1)
        header("Location: ../../GUI/PantallasDestino/AccesoDenegado.php");
        
    include '../../Core/Conexion.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    
    $nuevoUsuario = new Usuario();
    $usuarioDAL = new DALUsuario();

    $nuevaCredencial = new Credenciales();
    $credencialDAL = new DALCredenciales();
    
    $correoUsuario = $_POST['email'];
    $contrasenaUsuario = $_POST['contrasena'];

    $cedulaUsuario = $_POST['cedula'];
    $nombreUsuario = $_POST['nombre'];
    $apellido1Usuario = $_POST['apellido1'];
    $apellido2Usuario = $_POST['apellido2'];
    $idPerfilUsuario = $_POST['tipoPerfil'];
    
    $nuevoUsuario->setCedula($cedulaUsuario);
    $nuevoUsuario->setNombre($nombreUsuario);
    $nuevoUsuario->setApellido1($apellido1Usuario);
    $nuevoUsuario->setApellido2($apellido2Usuario);    
    $nuevoUsuario->setIdPerfil($idPerfilUsuario);

    if($usuarioDAL->BuscarCedula($cedulaUsuario) == false && $usuarioDAL->BuscarCorreo($correoUsuario) == false)
    {
        $idCredenciales = NuevaCredencial($correoUsuario, $contrasena);

        if(isset($idCredenciales))
        {        
            if(NuevoUsuario($nuevoUsuario, $idCredenciales))
                echo "AÑADIDO";
            else
                echo "NO AÑADIDO";
        }
        else
            echo "NO NUEVA CREDENCIAL";
    }
    else
    {
        echo "AH";
    }

    function NuevaCredencial($correo, $contrasena)
    {
        $nuevaCredencial = new Credenciales();
        $credencialDAL = new DALCredenciales();

        $nuevaCredencial->setCorreo($correo);
        $nuevaCredencial->setContrasena($contrasena);

        $idCredencial = $credencialDAL->NuevaCredencial($nuevaCredencial); 

        if(isset($idCredencial))
            echo $idCredencial;
        else 
            echo null;
    }

    function NuevoUsuario(Usuario $usuario, $idCredencial)
    {        
        $usuarioDAL = new DALUsuario();
        $usuario->setIdCredenciales($idCredencial);

        if($usuarioDAL->NuevoUsuario($usuario))
            echo true;
        else
            echo false;
    }


    // if($usuarioDAL->BuscarCedula($cedulaUsuario) == false && $credencialDAL->BuscarCorreo($correoUsuario) == false)
    // {                    
    //     if($credencialDAL->NuevaCredencial($nuevaCredencial))
    //     {
    //         //Obtener la ID de la credencial recien añadida
    //         $ultimaCredencial = $credencialDAL->UltimaCredencial();
            
            
    //         $idCredencialUsuario = $ultimaCredencial->getId();            

    //         //Nuevo Usuario
    //         if($usuarioDAL->NuevoUsuario($nuevoUsuario))
    //         {
    //             $_SESSION["Accion"] = "¡Nuevo Usuario añadido correctamente!";
    //             header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php");
    //         }
    //         else
    //         {
    //             $_SESSION["Accion"] = "Ocurrió un error al añadir al Usuario";
    //             header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");                
    //         }
    //     }
    //     else
    //     {
    //         $_SESSION["Accion"] = "Ocurrió un error a la<br>hora de añadir la credencial";
    //         header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    //     }
    // }
    // else
    // {
    //     $_SESSION["Accion"] = "El cedula ".$cedulaUsuario." o el correo ".$correoUsuario." ya existe en nuestro Sistema";
    //     header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    // }
    
/////////////////////////////////////////////////////////////////////////////