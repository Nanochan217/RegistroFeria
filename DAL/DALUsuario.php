<?php
    class DALUsuario
    {
        function NuevaCredencial(Credenciales $nuevaCredencial)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "INSERT INTO 'CREDENCIALES'('CORREO', 'CONTRASENA', 'ACTIVE') 
                VALUES ('".$nuevaCredencial->getCorreo()."','".$nuevaCredencial->getContrasena()."', 1)";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }
            $conexionDB->CerrarConexion();
            return $resultado;
        }

        //Método para buscar la ultima credencial creada y devolverla al BL
        function AsignarCredencial()
        {
            $ultimaCredencial = new Credenciales();
            $conexionDB = new Conexion();
            $consultaSql = "SELECT * FROM 'CREDENCIALES' WHERE 'id'=(SELECT MAX('id') FROM 'CREDENCIALES') AND 'ACTIVE' = 1;";
            $credencial = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($credencial)>0)
            {
                while($filaCredencial = $credencial->fetch_assoc())
                {
                    $ultimaCredencial->setId($filaCredencial["ID"]);
                    $ultimaCredencial->setCorreo($filaCredencial["CORREO"]);
                    $ultimaCredencial->setContrasena($filaCredencial["CONTRASENA"]);
                    $ultimaCredencial->setActive($filaCredencial["ACTIVE"]);
                }
            }
            else
            {
                $ultimaCredencial = null;
            }
            $conexionDB->CerrarConexion();
            return $ultimaCredencial;
        }

        function NuevoUsuario(Usuario $nuevoUsuario)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $credencialUsuario = "SELECT * FROM 'CREDENCIALES' WHERE 'id'=(SELECT MAX('id') FROM 'Credenciales');";
            $credencial = $conexionDB->NuevaConexion($credencialUsuario);

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


