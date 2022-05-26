<?php
//En proceso...
class DALComprobante
{    
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
            //Buscar una manera de recorrer los acompanantes (!)
            $pdfConfirmacion->Cell(0, 10, utf8_decode('Acompañante #'.$cantidadAcompanantes.': '.$citaAcompanante->getNombre()), 0, 1);
            $cantidadAcompanantes++;
        }      
        $pdfConfirmacion->Cell(0, 10, utf8_decode('Fecha de la Cita: '.$cita->getDia()), 0, 1);
        $pdfConfirmacion->Cell(0, 10, utf8_decode('Hora de la Cita: '.$cita->getHora()), 0, 1);
        $pdfConfirmacion->Ln();
        $pdfConfirmacion->Cell(0, 10, utf8_decode('¡No olvides confirmar tu reserva mediante el correo que te enviaremos pronto!'), 0, 1);
        $pdfConfirmacion->Cell(0, 10, utf8_decode('Con cariño, COVAO <3'), 0, 1);
        //$pdfConfirmacion->Ln();//SALTO DE LINEA
        
        //Incluir imagenes al PDF
        $pdfConfirmacion->Image('../../GUI/Assets/Images/logoCovao.png', null, null, 80);
        //D = Descargar, F = local, I = una dirección concreta (?)
        //return $pdfConfirmacion->Output('F', '../../ComprobantesCita/ComprobanteCita#'.$citaAcompanante->getIdCita().'.pdf', true); // save into some other location
        return $pdfConfirmacion->Output('D', 'ComprobanteCita#'.$citaAcompanante->getIdCita().'.pdf');
    }
}

///////////////////////////////////////////////////////////////////////////////////////////