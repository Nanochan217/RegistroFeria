<?php
    include '../../Core/Conexion.php';
    include '../../DAL/CitaDAL/DALCita.php';
    include '../../DAL/CitaDAL/DALAsistente.php';
    include '../../DAL/CitaDAL/DALAcompanante.php';
    include '../../Entidades/CitasEntidades/Cita.php';
    include '../../Entidades/CitasEntidades/Asistente.php';
    include '../../Entidades/CitasEntidades/Acompanante.php';

    $asistenteDAL = new DALAsistente();
    $citaDAL = new DALCita();
    $acompananteDAL = new DALAcompanante();

    //Arrays
    $datosAsistente = $_POST['asistente'];
    $datosCita = $_POST['cita'];
    $datosAcompanante = $_POST['acompanantes'];
    //echo "ola";

    $idAsistente = NuevoAsistente($datosAsistente);

    if (isset($idAsistente))
    {
        $idCita = CrearCita($datosCita, $idAsistente);

        if (isset($idCita))
        {
            if (NuevoAcompanante($datosAcompanante, $idCita))
                echo 1;
            else
            {
                $acompananteDAL->DesactivarAcompanante(null, $idCita);
                $citaDAL->DesactivarCita($idCita);
                echo 0;
            }
        }
        else
        {
            $asistenteDAL->DesactivarAsistente($idAsistente);
            echo 0;
        }
    }
    else
    {
        echo 0;
    }


    function NuevoAsistente($datosNuevoAsistente)
    {
        $asistenteDAL = new DALAsistente();
        $nuevoAsistente = new Asistente();

        $nuevoAsistente->setCedula($datosNuevoAsistente["cedula"]);
        $nuevoAsistente->setNombre($datosNuevoAsistente["nombre"]);
        $nuevoAsistente->setApellido1($datosNuevoAsistente["apellido1"]);
        $nuevoAsistente->setApellido2($datosNuevoAsistente["apellido2"]);
        $nuevoAsistente->setCorreo($datosNuevoAsistente["correo"]);
        $nuevoAsistente->setTelefono($datosNuevoAsistente["telefono"]);
        $nuevoAsistente->setIdColegioProcedencia($datosNuevoAsistente["idColegioProcedencia"]);


        $idNuevoAsistente = $asistenteDAL->NuevoAsistente($nuevoAsistente);

        if (isset($idNuevoAsistente))
            return $idNuevoAsistente;
        else
            return null;
    }

    function CrearCita($datosNuevoCita, $idAsistenteNuevo)
    {
        $citaDAL = new DALCita();
        $nuevaCita = new Cita();

        $nuevaCita->setDia($datosNuevoCita['fechaCita']);
        $nuevaCita->setHora($datosNuevoCita['horario']);
        $nuevaCita->setIdAsistente($idAsistenteNuevo);

        $idNuevaCita = $citaDAL->NuevaCita($nuevaCita);

        if (isset($idNuevaCita))
            return $idNuevaCita;
        else
            return null;
    }

    function NuevoAcompanante($datosNuevoAcompanante, $idCitaNueva)
    {
        $contador = 0;
        $resultado = true;
        $acompananteDAL = new DALAcompanante();
        $nuevoAcompanante = new Acompanante();    

        foreach ($datosNuevoAcompanante as $value)
        {
            $nuevoAcompanante->setCedula($value["cedula"]);
            $nuevoAcompanante->setNombre($value["nombre"]);
            $nuevoAcompanante->setIdTipoAcompanante($value["idTipoAcompanante"]);
            $nuevoAcompanante->setIdCita($idCitaNueva);

            if ($acompananteDAL->NuevoAcompanante($nuevoAcompanante))
                continue;
            else
            {
                $resultado = false;
                break;
            }
        }

        return $resultado;
    }
      
///////////////////////////////////////////////////////////////////////////////////////////