<?php
    class DALAsistente
    {
        function NuevoAsistente(Asistente $nuevoAsistente)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "INSERT INTO `ASISTENTE` (`CEDULA`,`NOMBRE`,`APELLIDO1`,`APELLIDO2`,`CORREO`,`TELEFONO`,`IDCOLEGIOPROCEDENCIA`,`ACTIVE`)
                            VALUES ('".$nuevoAsistente->getCedula()."','".$nuevoAsistente->getNombre()."','".$nuevoAsistente->getApellido1()."','".$nuevoAsistente->getApellido2()."'
                            ,'".$nuevoAsistente->getCorreo()."','".$nuevoAsistente->getTelefono()."','".$nuevoAsistente->getIdColegioProcedencia()."','".$nuevoAsistente->getActive()."')";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function UltimoAsistente()
        {
            $ultimoAsistenteDB = 0;
            $conexionDB = new Conexion();
            $consultaSql = "SELECT * FROM `ASISTENTE` WHERE `ID`=(SELECT MAX(`ID`) FROM `ASISTENTE`) AND `ACTIVE` = 1";
            $asistente = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($asistente)>0)
            {
                while($filaAsistente = $asistente->fetch_assoc())
                {
                    $ultimoAsistenteDB = $filaAsistente["id"];
                }
            }
            else
            {
                $ultimoAsistenteDB = null;
            }
            $conexionDB->CerrarConexion();
            return $ultimoAsistenteDB;
        }

        //Funcion para verificar que no existan datos iguales en la DB
        function BuscarCedula($cedula)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `ASISTENTE` WHERE `CEDULA` = '".$cedula."'";

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaAsistente = $respuestaDB->fetch_assoc())
                {
                    if($cedula != $filaAsistente["cedula"])
                        break;
                    else
                        $resultado = true;
                }
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }
    }