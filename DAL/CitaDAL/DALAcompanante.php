<?php
    class DALAcompanante
    {
        function NuevoAcompanante(Acompanante $nuevoAcompanante)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $consultaSql = "INSERT INTO `ACOMPANANTE` (`CEDULA`, `NOMBRE`,`IDTIPOACOMPANANTE`,`IDCITA`) 
            VALUES ('" . $nuevoAcompanante->getCedula() . "', '" . $nuevoAcompanante->getNombre() . "',
            '" . $nuevoAcompanante->getIdTipoAcompanante() . "','" . $nuevoAcompanante->getIdCita() . "')";

            if($conexionDB->NuevaConsulta($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        //Funcion para verificar que no existan datos iguales en la DB
        function BuscarCedula($cedula)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $consultaSql = "SELECT * FROM `ACOMPANANTE` WHERE `CEDULA` = '" . $cedula . "'  AND `ACTIVE` = 1";

            $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaAcompanante = $respuestaDB->fetch_assoc())
                {
                    if($cedula != $filaAcompanante["cedula"])
                        break;
                    else
                        $resultado = true;
                }
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function DesactivarAcompanante($idAcompanante)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $consultaSql = "UPDATE `ACOMPANANTE` SET `ACTIVE` = 0 WHERE `ID`= '" . $idAcompanante . "'";

            if($conexionDB->NuevaConsulta($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////