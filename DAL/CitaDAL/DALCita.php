<?php
    class DALCita
    {
        function NuevaCita(Cita $nuevaCita)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $consultaDB = "INSERT INTO `CITA` (`DIA`, `HORA`, `CONFIRMADO`, `IDASISTENTE`) 
            VALUES ('" . $nuevaCita->getDia() . "', '" . $nuevaCita->getHora() . "', '" . $nuevaCita->getConfirmado() . "',
            '" . $nuevaCita->getIdAsistente() . "')";

            if($conexionDB->NuevaConsulta($consultaDB))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        //Necesario revisar (!)
        function ModificarCita(Cita $modificarCita)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $consultaDB = "UPDATE `CITA` SET `DIA`='" . $modificarCita->getDia() . "',
            'HORA'='" . $modificarCita->getHora() . "'";

            if($conexionDB->NuevaConsulta($consultaDB))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function BuscarCita($idAsistente)
        {
            $citaConsultada = new Cita();
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();
            
            $consultaSql = "SELECT * FROM `CITA` WHERE `ACTIVE`=1 AND `IDASISTENTE`=" . $idAsistente;
            $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaCita = $respuestaDB->fetch_assoc())
                {
                    $citaConsultada->setId($filaCita["id"]);
                    $citaConsultada->setDia($filaCita["dia"]);
                    $citaConsultada->setHora($filaCita["hora"]);
                    $citaConsultada->setConfirmado($filaCita["confirmado"]);
                    $citaConsultada->setIdAsistente($filaCita["idAsistente"]);
                    $citaConsultada->setIdEstadoCita($filaCita["idEstadoCita"]);
                    $citaConsultada->setActive($filaCita["active"]);
                }
            }
            else
            {
                $citaConsultada = null;
            }

            $conexionDB->CerrarConexion();
            return $citaConsultada;
        }

        function BuscarTodasCitas()
        {
            $citasSistema = array();
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $consultaSql = "SELECT * FROM `CITAS` WHERE `ACTIVE` = 1";
            $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filasCitas = $respuestaDB->fetch_assoc())
                {
                    $citas = new Cita();
                    $citas->setId($filasCitas["id"]);
                    $citas->setDia($filasCitas["dia"]);
                    $citas->setHora($filasCitas["hora"]);
                    $citas->setConfirmado($filasCitas["confirmado"]);
                    $citas->setIdAsistente($filasCitas["idAsistente"]);
                    $citas->setIdEstadoCita($filasCitas["idEstadoCita"]);
                    $citas->setActive($filasCitas["active"]);
                    $citasSistema[]=$citas;
                }
            }
            else
            {
                $citasSistema = null;
            }

            $conexionDB->CerrarConexion();
            return $citasSistema;
        }

        function DesactivarCita($idCita)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $consultaSql = "UPDATE `CITA` SET `ACTIVE` = 0 WHERE `ID`='" . $idCita . "'";

            if($conexionDB->NuevaConsulta($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function UltimaCita()
        {
            $ultimaCitaDB = 0;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();
            
            $consultaSql = "SELECT * FROM `CITA` WHERE `ID`=(SELECT MAX(`ID`) FROM `CITA`) AND `ACTIVE` = 1";
            $cita = $conexionDB->NuevaConsulta($consultaSql);

            if(mysqli_num_rows($cita)>0)
            {
                while($filaCita = $cita->fetch_assoc())
                {
                    $ultimaCitaDB = $filaCita["id"];
                }
            }
            else
            {
                $ultimaCitaDB = null;
            }
            $conexionDB->CerrarConexion();
            return $ultimaCitaDB;
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////