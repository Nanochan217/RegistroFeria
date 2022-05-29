<?php
    class DALAsistente
    {
        function NuevoAsistente(Asistente $nuevoAsistente)
        {
            $resultado = 0;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion();

            $consultaSql = "INSERT INTO `ASISTENTE` (`CEDULA`, `NOMBRE`, `APELLIDO1`, `APELLIDO2`, `CORREO`, `TELEFONO`, `IDCOLEGIOPROCEDENCIA`)
            VALUES ('" . $nuevoAsistente->getCedula() . "', '" . $nuevoAsistente->getNombre() . "', '" . $nuevoAsistente->getApellido1() . "',
            '" . $nuevoAsistente->getApellido2() . "', '" . $nuevoAsistente->getCorreo() . "', '" . $nuevoAsistente->getTelefono() . "',
            '" . $nuevoAsistente->getIdColegioProcedencia() . "')";
            
            if($conexionDB->NuevaConsulta($consultaSql))
                $resultado = $conexionDB->ObtenerIdUltimoInsert();
            else
                $resultado = null;

            $conexionDB->CerrarConexion();
            return $resultado;
        }
        
        function BuscarCedula($cedula)
        {
            $resultado = 0;
            $contador = 1;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion();

            $primeraConsulta = "SELECT * FROM `ASISTENTE` WHERE `CEDULA` = '" . $cedula . "'  AND `ACTIVE` = 1";
            $segundaConsulta = "SELECT * FROM `ACOMPANANTE` WHERE `CEDULA` = '" . $cedula . "'  AND `ACTIVE` = 1";
            
            while($contador <= 2)
            {
                if($contador == 1)
                    $respuestaDB = $conexionDB->NuevaConsulta($primeraConsulta);
                else if($contador == 2)
                    $respuestaDB = $conexionDB->NuevaConsulta($segundaConsulta);

                if(mysqli_num_rows($respuestaDB)>0)
                {
                    while($fila = $respuestaDB->fetch_assoc())
                    {
                        if($cedula != $fila["cedula"])
                            break;
                        else
                            $resultado++;
                    }
                }

                $contador++;
            }

            $conexionDB->CerrarConexion();
            
            if($resultado == 0)            
                return true;   
            else
                return false;                        
        }

        function BuscarCorreo($correo)
        {
            $resultado = true;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion();

            $consultaSql = "SELECT * FROM `ASISTENTE` WHERE `CORREO` = '" . $correo . "'  AND `ACTIVE` = 1";
            $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($fila = $respuestaDB->fetch_assoc())
                {
                    if($correo != $fila["correo"])
                        break;
                    else
                        $resultado = false;
                }
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function BuscarTelefono($telefono)
        {
            $resultado = true;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion();

            $consultaSql = "SELECT * FROM `ASISTENTE` WHERE `TELEFONO` = '" . $telefono . "'  AND `ACTIVE` = 1";
            $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($fila = $respuestaDB->fetch_assoc())
                {
                    if($telefono != $fila["telefono"])
                        break;
                    else
                        $resultado = false;
                }
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function DesactivarAsistente($idAsistente)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion();

            $consultaSql = "UPDATE `ASISTENTE` SET `ACTIVE` = 0 WHERE `ID`= '" . $idAsistente . "'";

            if($conexionDB->NuevaConsulta($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////