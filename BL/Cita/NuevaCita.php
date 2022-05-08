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

    //Objetos para almacenar los datos del Formulario
    $nuevoAsistente = new Asistente();
    $nuevoAcompanante = new Acompanante();
    $nuevaCita = new Cita();

    //Datos del Asistente
    $cedulaAsistente = $_POST['cedula'];
    $nombreAsistente = $_POST['nombre'];
    $apellido1Asistente = $_POST['apellido1'];
    $apellido2Asistente = $_POST['apellido2'];
    $correoAsistente = $_POST['email'];
    $telefonoAsistente = $_POST['telefono'];
    $colegioAsistente = $_POST['colegioProcedencia'];

    // //Datos de la Cita
    $diaCita = $_POST['dia'];
    $horaCita = $_POST['horario'];

    // //Datos del Acompañante
    // //¿LAS IDS DE LOS INPUTS DE LA CEDULA Y EL TIPO AUTOINCREMENTAN?
    $listaAcompanantes = $_POST['listaAcompanante'];//OPCIONAL
    $cedulaAcompanante = $_POST['cedulaAcompanante1'];
    $tipoAcompanante = $_POST['parentescoAcompanante1'];

    //SEGUIR CON LA ADICIÓN DE CITAS (VER SI LOS INPUTS DEL ACOMPANANTE AUTOINCREMENTAN)
    if($asistenteDAL->BuscarCedula($cedulaAsistente) == false && $acompananteDAL->BuscarCedula($cedulaAcompanante) == false)
    {
        //Asignación en el Objeto Asistente con los datos del Formulario
        $nuevoAsistente->setCedula($cedulaAsistente);
        $nuevoAsistente->setNombre($nombreAsistente);
        $nuevoAsistente->setApellido1($apellido1Asistente);
        $nuevoAsistente->setApellido2($apellido2Asistente);
        $nuevoAsistente->setCorreo($correoAsistente);
        $nuevoAsistente->setTelefono($telefonoAsistente);
        $nuevoAsistente->setIdColegioProcedencia($colegioAsistente);
        $nuevoAsistente->setActive(1);

        if($asistenteDAL->NuevoAsistente($nuevoAsistente))
        {
            //Se obtiene la ID del último registro del Asistente
            $idAsistente = $asistenteDAL->UltimoAsistente();

            //Asignación en el Objeto Cita con los datos del Formulario
            $nuevaCita->setDia($diaCita);
            $nuevaCita->setHora($horaCita);
            $nuevaCita->setConfirmado(0);
            $nuevaCita->setIdAsistente($idAsistente);
            $nuevaCita->setIdEstadoCita(2);
            $nuevaCita->setActive(1);

            if($citaDAL->NuevaCita($nuevaCita))
            {
                //Se obtiene la ID del último registro de la Cita
                $idCita = $citaDAL->UltimaCita();

                //Asignación en el Objeto Acompanante con los datos del Formulario
                $nuevoAcompanante->setCedula($cedulaAcompanante);
                $nuevoAcompanante->setIdTipoAcompanante($tipoAcompanante);
                $nuevoAcompanante->setIdCita($idCita);
                $nuevoAcompanante->setActive(1);
                $acompananteDAL->NuevoAcompanante($nuevoAcompanante);
            }
            else
            {
                header("Location: ../../GUI/Index/Index.php");
                echo "Ha ocurrido un error";
            }
        }
        else
        {
            header("Location: ../../GUI/Index/Index.php");
            echo "Ha ocurrido un error";
        }
    }
    else
    {
        header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    }

    






