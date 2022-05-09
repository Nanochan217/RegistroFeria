<?php
    class DALCita
    {
        function NuevaCita(Cita $nuevaCita)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaDB = "INSERT INTO `CITA` (`DIA`, `HORA`, `CONFIRMADO`, `IDASISTENTE`, `IDESTADOCITA`, `ACTIVE`) 
            VALUES ('".$nuevaCita->getDia()."', '".$nuevaCita->getHora()."', '".$nuevaCita->getConfirmado()."',
            '".$nuevaCita->getIdAsistente()."', 2, 1)";

            if($conexionDB->NuevaConexion($consultaDB))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        //OJO CON LA CONSULTA SQL (REVISAR Y COMPARAR CON LA DE USUARIOS...)
        function ModificarCita(Cita $modificarCita)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaDB = "UPDATE `CITA` SET `DIA`='".$modificarCita->getDia()."' SET 'HORA'='".$modificarCita->getHora()."'";

            if($conexionDB->NuevaConexion($consultaDB))
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

            //PENDIENTE VER COMO BUSCAR LA CEDULA (PROBABLEMENTE SE BUSCARA POR ID)
            $consultaSql = "SELECT * FROM `CITA` WHERE `ACTIVE`=1 AND `IDASISTENTE`=".$idAsistente;
            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

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

            $consultaSql = "SELECT * FROM `CITAS` WHERE `ACTIVE` = 1";
            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

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

            $consultaSql = "UPDATE `CITA` SET `ACTIVE` = 0 WHERE `ID`='".$idCita."'";

            if($conexionDB->NuevaConexion($consultaSql))
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
            $consultaSql = "SELECT * FROM `CITA` WHERE `ID`=(SELECT MAX(`ID`) FROM `CITA`) AND `ACTIVE` = 1";
            $cita = $conexionDB->NuevaConexion($consultaSql);

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
