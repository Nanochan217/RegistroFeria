<?php
    class DALUsuario
    {
        //Añade un nuevo Usuario a la Base de Datos
        function NuevoUsuario(Usuario $nuevoUsuario)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "INSERT INTO 'USUARIO'('CEDULA', 'NOMBRE', 'APELLIDO1', 'APELLIDO2', 'IDCREDENCIAL', 'IDPERFIL', 'ACTIVE') 
                    VALUES ('".$nuevoUsuario->getCedula()."','".$nuevoUsuario->getNombre()."','".$nuevoUsuario->getApellido1()."',
                    '".$nuevoUsuario->getApellido2()."','".$nuevoUsuario->getIdCredenciales()."','".$nuevoUsuario->getIdPerfil()."', 1)";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }
            $conexionDB->CerrarConexion();
            return $resultado;
        }

        //PENDIENTE
        function ActualizarUsuario(Usuario $actualizarUsuario)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "QUERY";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }
            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function BuscarTodosUsuario()
        {
            $usuariosDB = array();
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM 'USUARIO' WHERE 'ACTIVE' = 1 
                                INNER JOIN 'CREDENCIALES' ON 'USUARIO.IDCREDENCIALES'='CREDENCIALES.ID'";

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filasUsuario = $respuestaDB->fetch_assoc())
                {
                    $usuario = new Usuario();
                    $usuario->setId($filasUsuario["ID"]);
                    $usuario->setCedula($filasUsuario["CEDULA"]);
                    $usuario->setNombre($filasUsuario["NOMBRE"]);
                    $usuario->setApellido1($filasUsuario["APELLIDO1"]);
                    $usuario->setApellido2($filasUsuario["APELLIDO2"]);
                    $usuario->setIdCredenciales($filasUsuario["IDCREDENCIALES"]);
                    $usuario->setIdPerfil($filasUsuario["IDPERFIL"]);
                    //VER CORREO Y CONTRASEÑA PARA LA TABLA DE CREDENCIALES
                }
            }
            else
            {
                $usuariosDB = null;
            }
            $conexionDB->CerrarConexion();
            return $usuariosDB;
        }

        function BuscarIdUsuario($idUsuario)
        {
            $usuarioDB = new Usuario();
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM 'USUARIO' WHERE 'ID' = '$idUsuario' 
                                INNER JOIN 'CREDENCIALES' ON 'USUARIO.IDCREDENCIALES'='CREDENCIALES.ID'";

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaUsuario = $respuestaDB->fetch_assoc())
                {
                    $usuarioDB->setId($filaUsuario["ID"]);
                    $usuarioDB->setCedula($filaUsuario["CEDULA"]);
                    $usuarioDB->setNombre($filaUsuario["NOMBRE"]);
                    $usuarioDB->setApellido1($filaUsuario["APELLIDO1"]);
                    $usuarioDB->setApellido2($filaUsuario["APELLIDO2"]);
                    $usuarioDB->setIdCredenciales($filaUsuario["IDCREDENCIALES"]);
                    $usuarioDB->setIdPerfil($filaUsuario["IDPERFIL"]);
                    //VER CORREO Y CONTRASEÑA PARA LA TABLA DE CREDENCIALES
                }
            }
            else
            {
                $usuarioDB = null;
            }
            $conexionDB->CerrarConexion();
            return $usuarioDB;
        }
    }
