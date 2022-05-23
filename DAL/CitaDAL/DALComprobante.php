<?php

class DALComprobante
{
//    function CargarDocumento($nuevoComprobante)
//    {               
//        // Variables de credenciales.
//        $claveJSON = '1O_FHVV1csu4dN9Cu9v7SJH8SWQN_lKje';
//        $pathJSON = 'registroferia-3f6c57c2891d.json';
//
//        //configurar variable de entorno
//        putenv('GOOGLE_APPLICATION_CREDENTIALS='.$pathJSON);
//
//        $cliente = new Google_Client();
//        $cliente->useApplicationDefaultCredentials();
//        $cliente->setScopes(['https://www.googleapis.com/auth/drive.file']);
//        try{		
//            //instanciamos el servicio
//            $servicio = new Google_Service_Drive($cliente);
//
//            //instacia de archivo
//            $archivo = new Google_Service_Drive_DriveFile();
//            $archivo->setName($nuevoComprobante);
//
//            //obtenemos el mime type
//            $finfo = finfo_open(FILEINFO_MIME_TYPE); 
//            $mime_type=finfo_file($finfo, $nuevoComprobante);
//
//            //id de la carpeta donde hemos dado el permiso a la cuenta de servicio 
//            $archivo->setParents(array($claveJSON));
//            //$file->setDescription($descripcion);DESCRIPCION NO NECESARIA (?)
//            $archivo->setMimeType($mime_type);
//
//            $resultado = $servicio->files->create(
//                $archivo,
//                array(
//                    'data' => file_get_contents($nuevoComprobante),
//                    'mimeType' => $mime_type,
//                    'uploadType' => 'media',
//                )
//            );
//            
//            /* FICHERO SUBIDO A GOOGLE DRIVE */
//            //echo "2.- Fichero subido a Google Drive.";
//            return 'https://drive.google.com/open?id='.$resultado->id;
//            
//        }catch(Google_Service_Exception $gs){
//            $m=json_decode($gs->getMessage());
//            echo $m->error->message;
//        }catch(Exception $e){
//            echo $e->getMessage();
//        }
//        
//        //registroferiacovao@registroferia.iam.gserviceaccount.com
//        //https://drive.google.com/drive/folders/1O_FHVV1csu4dN9Cu9v7SJH8SWQN_lKje?usp=sharing
//        //return $enlaceDocumento;
//    }                                           
    
    function BuscarDocumento($idComprobanteCita)
    {
        //PARA EL BOTON DE DESCARGA O VISUALIZACION DE COMPROBANTE (?) DEVUELVE EL ENLACE... (???)
    }
    
    function NuevoComprobante(Comprobante $nuevoComprobante)
    {
        $resultado = false;
        $conexionDB = new Conexion();
        
        $consultaSql = "INSERT INTO `COMPROBANTECITA` (`NOMBRECOMPROBANTE`,`DESCRIPCION`,`FECHACOMPROBANTE`,`IDCITA`,`DOCUMENTO`,`ACTIVE`)
                 VALUES ('".$nuevoComprobante->getNombreComprobante()."', '".$nuevoComprobante->getDescripcion()."', 
                 '".$nuevoComprobante->getFechaComprobante()."', '".$nuevoComprobante->getIdCita()."', '".$nuevoComprobante->getDocumento()."', 1)";
        
        if($conexionDB->NuevaConexion($consultaSql))
        {
           $resultado = true;
        }
        
        $conexionDB->CerrarConexion();
        return $resultado;
    }
    
    function GenerarPDF(Asistente $asistenteSolicitante, Acompanante $citaAcompanante, Cita $cita, $cantidad)
    {
        $cantidadAcompanantes = 1;
        $pdfConfirmacion = new FPDF();
        $pdfConfirmacion->AddPage();
        
        $pdfConfirmacion->SetFont('Arial', '', 12);
        $pdfConfirmacion->Cell(0, 10, utf8_decode('Hemos recibido que solicitaste una Cita a la Feria Vocacional del COVAO'), 0, 1);        
        $pdfConfirmacion->Cell(0, 10, utf8_decode('Tu número de Cita es: '.$citaAcompanante->getIdCita()), 0, 1);
        $pdfConfirmacion->Cell(0, 10, utf8_decode('Nombre del Solicitante: '.$asistenteSolicitante->getNombre().' '.$asistenteSolicitante->getApellido1().' '.$asistenteSolicitante->getApellido2()), 0, 1);
        $pdfConfirmacion->Cell(0, 10, utf8_decode('Cantidad de Acompañantes: '.$cantidad), 0, 1);
        while($cantidadAcompanantes <= $cantidad)
        {
            //Buscar una manera de recorrer los acompanantes (?)
            $pdfConfirmacion->Cell(0, 10, utf8_decode('Acompañante #'.$cantidadAcompanantes.': '.$citaAcompanante->getNombre()), 0, 1);
            $cantidadAcompanantes++;
        }      
        $pdfConfirmacion->Cell(0, 10, utf8_decode('Fecha de la Cita: '.$cita->getDia()), 0, 1);
        $pdfConfirmacion->Cell(0, 10, utf8_decode('Hora de la Cita: '.$cita->getHora()), 0, 1);
        $pdfConfirmacion->Ln();
        $pdfConfirmacion->Cell(0, 10, utf8_decode('¡No olvides confirmar tu reserva mediante el correo que te enviaremos pronto!'), 0, 1);
        $pdfConfirmacion->Cell(0, 10, utf8_decode('Con cariño, COVAO <3'), 0, 1);
        //$pdfConfirmacion->Ln(); SALTO DE LINEA
        //Incluir imagenes al PDF
        $pdfConfirmacion->Image('../../GUI/Assets/Images/logoCovao.png', null, null, 80);
        //D = Descargar, F = local, I = una dirección concreta (?) OJOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
        return $pdfConfirmacion->Output('D', 'ComprobanteCita#'.$citaAcompanante->getIdCita().'.pdf');
    }
}

