<?php
    //include_once '../../Core/DriveAPI/vendor/autoload.php';
    include '../../Core/GenerarPDF/fpdf/fpdf.php';
    include '../../Core/Conexion.php';
    include '../../DAL/CitaDAL/DALCita.php';
    include '../../DAL/CitaDAL/DALAsistente.php';
    include '../../DAL/CitaDAL/DALAcompanante.php';
    include '../../DAL/CitaDAL/DALComprobante.php';
    include '../../Entidades/CitasEntidades/Cita.php';
    include '../../Entidades/CitasEntidades/Asistente.php';
    include '../../Entidades/CitasEntidades/Acompanante.php';
    include '../../Entidades/CitasEntidades/Comprobante.php';
    
    //APLICAR LOS ARRAYS DESDE EL FORM Y MODIFICAR ESTE CÓDIGO!!!
    
    $cedulasRegistradas = array();
    $contador = 1;
    $asistenteDAL = new DALAsistente();
    $citaDAL = new DALCita();
    $acompananteDAL = new DALAcompanante();
    $comprobanteCita = new DALComprobante();
    
    //Estado de los Acompañantes
    $estadoAcompanantes = $_POST['estadoAcompanantes'];
    //Cantidad de Acompañantes
    $cantidadAcompanantes = $_POST['cantidadAcompanantes'];
    
    //Objetos para almacenar los datos del Formulario
    $nuevoAsistente = new Asistente();
    $nuevoAcompanante = new Acompanante();
    $nuevaCita = new Cita();
    $nuevoComprobante = new Comprobante();

    //Datos del Asistente
    $cedulaAsistente = $_POST['cedula'];
    $nombreAsistente = $_POST['nombre'];
    $apellido1Asistente = $_POST['apellido1'];
    $apellido2Asistente = $_POST['apellido2'];
    $correoAsistente = $_POST['email'];
    $telefonoAsistente = $_POST['telefono'];
    $colegioAsistente = $_POST['colegioProcedencia'];

    // //Datos de la Cita
    $diaCita = $_POST['diaCita'];
    $horaCita = $_POST['horarioCita'];

    if($asistenteDAL->BuscarCedula($cedulaAsistente) == false)
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
                $idCita = $citaDAL->UltimaCita();

                // if($estadoAcompanantes !== "N")
                // {
                    while($contador <= $cantidadAcompanantes)
                    {  
                        //Datos del Acompañante      
                        $cedulaAcompanante = $_POST['cedulaAcompanante'.$contador];
                        $nombreAcompanante = $_POST['nombreAcompanante'.$contador];
                        $tipoAcompanante = $_POST['parentescoAcompanante'.$contador];

                        //Asignación en el Objeto Acompanante con los datos del Formulario
                        $nuevoAcompanante->setCedula($cedulaAcompanante);
                        $nuevoAcompanante->setNombre($nombreAcompanante);
                        $nuevoAcompanante->setIdTipoAcompanante($tipoAcompanante);
                        $nuevoAcompanante->setIdCita($idCita);
                        $nuevoAcompanante->setActive(1);

                        if($acompananteDAL->BuscarCedula($cedulaAcompanante) == false)
                        {
                            //echo "<h1>'".$cedulaAcompanante."'</h1>";
                            if($acompananteDAL->NuevoAcompanante($nuevoAcompanante))
                            {
                                //Siguiente ciclo...
                                $contador++;
                            }
                            else
                            {
                                //echo "<h1>NUEVA ACOMPANANTE ERROR</h1>";
                                $citaDAL->DesactivarCita($idCita);
                                $asistenteDAL->DesactivarAsistente($idAsistente);
                                break;
                                header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
                            }
                        }
                        // else
                        // {
                        //     //FALTA COMPROBAR (HACER USO DE JSON PARA OBTENER LOS DATOS Y MOSTRARLOS EN UN MODAL DE ADVERTENCIA)
                        //     //ESTO CONLLEVARÁ A HACER USO DE OTRO DOCUMENTO DE PHP PARA VERIFICAR LAS CEDULAS (VER NOTAS EN EL CUADERNO)
                        //     $cedulasRegistradas[] = $cedulaAcompanante;
                        //     $contador++;                        
                        // }
                    }

                    //if($contador == $cantidadAcompanantes)
                        header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php");
                //}                
                                                                                
                // $comprobanteCita->GenerarPDF($nuevoAsistente , $nuevoAcompanante, $nuevaCita, $contador);
                // echo "../../ComprobantesCita/ComprobanteCita#".$idCita.".pdf";
            }
            else
            {
                //echo "<h1>NUEVA CITA ERROR</h1>";
                $asistenteDAL->DesactivarAsistente($idAsistente);
                header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
            }
        }
        else
        {
            //echo "<h1>NUEVO ASISTENTE ERROR</h1>";
            header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
        }
    }
    else
    {
        //echo "<h1>CEDULAS IGUALES ERROR</h1>";
        header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    }        
    