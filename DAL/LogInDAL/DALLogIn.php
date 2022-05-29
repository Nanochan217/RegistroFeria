<?php
    class DALLogIn
    {
        function NuevaSesionUsuario(Credenciales $credencialesSesion)
        {
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $correoUsuario = $credencialesSesion->getCorreo();
            $contrasenaUsuario = $credencialesSesion->getContrasena();            
            
            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `CORREO` = '" . $correoUsuario . "' AND `ACTIVE` = 1";
            
            $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);
            
            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaCredencial = $respuestaDB->fetch_assoc())
                {
                    //verifica la contraseña del Log In con el Hash (contraseña encriptada)
                    if(password_verify($contrasenaUsuario, $filaCredencial["contrasena"]))
                    {                                                          
                        $credencialesSesion->setId($filaCredencial["id"]);
                    }
                    else
                    {
                        $credencialesSesion = null;
                    }
                }
            }
            else
            {
                $credencialesSesion = null;
            }
            
            $conexionDB->CerrarConexion();
            return $credencialesSesion;                        
        }

        //En proceso...
        //VALORAR CAMBIAR EL FLUJO DE EJECUCION EN CUYO CASO
        //SE DEBERA PRIMERO AÑADIR LA SOLICITUD (GENERAR UN STRING ALEAT.) 
        //Y DESPUES CONSULTAR DICHA TABLA EN LA VERIFICACION DE CORREO
        //EXTRAER ESOS DATOS Y CONCATENARLOS EN EL HTML...
        function CorreoRestablecerContrasena(Solicitudes $solitudCambioContrasena)
        {
            $correoUsuario = $solitudCambioContrasena->getCodigoSolicitud();            
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `CORREO` ='" . $correoUsuario . "' AND `ACTIVE`= 1";

            if($conexionDB->NuevaConsulta($consultaSql))
            {            
                //ADJUNTAR AL LINK COMO VARIABLE DE PHP (?cod=$hashSolicitud)!!
                $hashSolicitud = crypt($correoUsuario, 'rl');                                

                $to = $correoUsuario;
                $tituloCorreo = "Solicitud de Restablecimiento de Contraseña";
                $html = $this->HtmlContrasenaCorreo($solitudCambioContrasena, $hashSolicitud);

                $cuerpoCorreo = $html;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <feriavocacionalcovao@gmail.com>' . "\r\n";
                
                if (mail($to, $tituloCorreo, $cuerpoCorreo, $headers))
                {                    
                    $resultado = true;                    
                }                
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }                

        function NuevaSolicitudContrasena(Solicitudes $nuevaSolicitud)
        {   
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $codigoNuevaSolicitud = $nuevaSolicitud->getCodigoSolicitud();
                        
            $hashSolicitud = crypt($codigoNuevaSolicitud, 'rl');                        

            $consultaSql = "INSERT INTO `SOLICITUDNUEVACONTRASENA` (`FECHASOLICITUD`, `FECHAEXPIRACION`, `CODIGOSOLICITUD`, `ACTIVE`)
                VALUES ('" . $nuevaSolicitud->getFechaSolicitud() . "', '" . $nuevaSolicitud->getFechaExpiracion() . "', '" . $hashSolicitud . "', 1)";
                        
            if($conexionDB->NuevaConsulta($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        //Parametro obtenido por GET en el BL de Nueva Contraseña
        function BuscarSolicitudContrasena($codigoSolicitud, $correo)
        {
            $solicitudUsuario = "";
            $fechaConsulta = strtotime(date("d-m-y H:i:s",time()));            
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            if(isset($codigoSolicitud))
            {
                $consultaSql = "SELECT * FROM `SOLICITUDNUEVACONTRASENA` WHERE `CODIGOSOLICITUD` = '" . $codigoSolicitud . "' AND `ACTIVE` = 1";
            }
            else if(isset($correo))
            {
                $consultaSql = "SELECT * FROM `SOLICITUDNUEVACONTRASENA` WHERE `CORREOUSUARIO` = '" . $correo . "' AND `ACTIVE` = 1";
            }
            
            $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaSolicitud = $respuestaDB->fetch_assoc())
                {                    
                    if($fechaConsulta <= strtotime($filaSolicitud["fechaExpiracion"]))
                    {
                        if(password_verify($codigoSolicitud, $filaSolicitud["codigoSolicitud"]))
                        {                            
                            $solicitudUsuario = $filaSolicitud["correoUsuario"];
                        }
                        else
                        {
                            $solicitudUsuario = "Denegado";
                        }
                    }
                    else
                    {
                        $solicitudUsuario = "Expirado";
                    }
                }
            }

            $conexionDB->CerrarConexion();
            return $solicitudUsuario;
        }

        function RestablecerContrasena($correoUsuario, $nuevaContraseña)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            $contrasenaEncriptada = password_hash($nuevaContraseña, PASSWORD_DEFAULT);

            $consultaSql = "UPDATE `CREDENCIALES` SET `CONTRASENA`='" . $contrasenaEncriptada . "' WHERE `CORREO`=" . $correoUsuario;

            if($conexionDB->NuevaConsulta($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function DesactivarSolicitud($codigoSolicitud, $correo)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion2();

            if(isset($codigoSolicitud))
            {
                $consultaSql = "UPDATE `SOLICITUDNUEVACONTRASENA` SET `ACTIVE` = 0 WHERE `CODIGOSOLICITUD` = '" . $codigoSolicitud . "'";
            }
            else if(isset($correo))
            {
                $consultaSql = "UPDATE `SOLICITUDNUEVACONTRASENA` SET `ACTIVE` = 0 WHERE `CORREOUSUARIO` = '" . $correo . "'";
            }            

            if($conexionDB->NuevaConsulta($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function HtmlContrasenaCorreo(Solicitudes $nuevaSolicitud, $codigoSolicitud)
        {
            $nuevoHtml = "
            <!DOCTYPE html>
            <html lang='es-ES' xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:v='urn:schemas-microsoft-com:vml'>
            <head>
                <title></title>
                <meta content='text/html; charset=utf-8' http-equiv='Content-Type'/>
                <meta content='width=device-width, initial-scale=1.0' name='viewport'/>
                <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
                <!--[if !mso]><!-->
                <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
                <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet' type='text/css'/>
                <!--<![endif]-->
                <style>
                        * {
                            box-sizing: border-box;
                        }
            
                        body {
                            margin: 0;
                            padding: 0;
                        }
            
                        a[x-apple-data-detectors] {
                            color: inherit !important;
                            text-decoration: inherit !important;
                        }
            
                        #MessageViewBody a {
                            color: inherit;
                            text-decoration: none;
                        }
            
                        p {
                            line-height: inherit
                        }
            
                        .desktop_hide,
                        .desktop_hide table {
                            mso-hide: all;
                            display: none;
                            max-height: 0px;
                            overflow: hidden;
                        }
            
                        @media (max-width:620px) {
                            .row-content {
                                width: 100% !important;
                            }
            
                            .column .border,
                            .mobile_hide {
                                display: none;
                            }
            
                            table {
                                table-layout: fixed !important;
                            }
            
                            .stack .column {
                                width: 100%;
                                display: block;
                            }
            
                            .mobile_hide {
                                min-height: 0;
                                max-height: 0;
                                max-width: 0;
                                overflow: hidden;
                                font-size: 0px;
                            }
            
                            .desktop_hide,
                            .desktop_hide table {
                                display: table !important;
                                max-height: none !important;
                            }
                        }
                    </style>
            </head>
            
            <body style='background-color: #ffffff; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;'>
                <table border='0' cellpadding='0' cellspacing='0' class='nl-container' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;' width='100%'>
                    <tbody>
                        <tr>
                            <td>
                                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-1' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px;' width='600'>
                                                    <tbody>
                                                        <tr>
                                                            <td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-left: 30px; padding-right: 30px; padding-top: 30px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                                                <table border='0' cellpadding='0' cellspacing='0' class='image_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                                    <tr>
                                                                        <td style='width:100%;padding-right:0px;padding-left:0px;'>
                                                                            <div align='center' style='line-height:10px'><img src='images/covao-logo-1.png' style='display: block; height: auto; border: 0; width: 243px; max-width: 100%;' width='243'/></div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table border='0' cellpadding='0' cellspacing='0' class='heading_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                                    <tr>
                                                                        <td style='padding-bottom:30px;padding-top:20px;text-align:center;width:100%;'>
                                                                            <h1 style='margin: 0; color: #323232; direction: ltr; font-family: Nunito, Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 42px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><span class='tinyMce-placeholder'>Restablecer contraseña</span></h1>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                                <tr>
                                                                    <td style='padding-bottom:10px;padding-top:10px;'>
                                                                        <div style='color:#4a4a4a;direction:ltr;font-family:Nunito, Arial, Helvetica Neue, Helvetica, sans-serif;font-size:15px;font-weight:400;letter-spacing:0px;line-height:200%;text-align:left;'>
                                                                            <p style='margin: 0;'><span style='color: #292929; font-family: Nunito, sans-serif; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;'>Después de hacer clic en el botón, se le pedirá que complete los siguientes pasos:</span></p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </table>
                                                                <table border='0' cellpadding='10' cellspacing='0' class='list_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                                    <tr>
                                                                        <td>
                                                                            <ol start='1' style='margin: 0; padding: 0; margin-left: 20px; list-style-type: decimal; color: #393d47; direction: ltr; font-family: Nunito, Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 15px; font-weight: 400; letter-spacing: 0px; line-height: 200%; text-align: left;'>
                                                                                <li style='margin-bottom: 0px;'>Introduzca una nueva contraseña.</li>
                                                                                <li style='margin-bottom: 0px;'>Confirme la nueva contraseña.</li>
                                                                                <li>Haga clic en restablecer contraseña.</li>
                                                                            </ol>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table border='0' cellpadding='0' cellspacing='0' class='button_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                                    <tr>
                                                                        <td style='padding-bottom:10px;padding-left:30px;padding-right:30px;padding-top:20px;text-align:center;'>
                                                                            <div align='center'>
                                                                                <!--[if mso]><v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' style='height:51px;width:245px;v-text-anchor:middle;' arcsize='8%' stroke='false' fillcolor='#0d6efd'><w:anchorlock/><v:textbox inset='0px,0px,0px,0px'><center style='color:#ffffff; font-family:Arial, sans-serif; font-size:16px'><![endif]-->
                                                                                <div style='text-decoration:none;display:inline-block;color:#ffffff;background-color:#0d6efd;border-radius:4px;width:auto;border-top:1px solid #0d6efd;font-weight:700;border-right:1px solid #0d6efd;border-bottom:1px solid #0d6efd;border-left:1px solid #0d6efd;padding-top:10px;padding-bottom:10px;font-family:Nunito, Arial, Helvetica Neue, Helvetica, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;'>
                                                                                    <span style='padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;letter-spacing:1px;'><span style='font-size: 16px; margin: 0; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;'>Restablecer Contraseña</span></span>
                                                                                </div>
                                                                                <!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                                    <tr>
                                                                        <td style='padding-bottom:10px;padding-top:10px;'>
                                                                            <div style='color:#4a4a4a;direction:ltr;font-family:Nunito, Arial, Helvetica Neue, Helvetica, sans-serif;font-size:14px;font-weight:400;letter-spacing:0px;line-height:200%;text-align:center;'>
                                                                                <p style='margin: 0;'>Este enlace es válido para un solo uso. Caduca en 2 horas.</p>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-2' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px;' width='600'>
                                                    <tbody>
                                                        <tr>
                                                            <td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 30px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                                                <table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                                    <tr>
                                                                        <td style='padding-bottom:10px;padding-left:30px;padding-right:30px;padding-top:20px;'>
                                                                        <div style='color:#393d47;direction:ltr;font-family:Nunito, Arial, Helvetica Neue, Helvetica, sans-serif;font-size:14px;font-weight:400;letter-spacing:0px;line-height:180%;text-align:center;'>
                                                                        <p style='margin: 0;'>En caso de consultas escribir a <a href='mailto:info_diurno@covao.ed.cr' rel='noopener' style='text-decoration: underline; color: #0d6efd;' target='_blank' title='info_diurno@covao.ed.cr'>info_diurno@covao.ed.cr </a>o mediante llamada telefónica al número: <a href='tel:+506%202537%200505' rel='noopener' style='text-decoration: underline; color: #0d6efd;' target='_blank' title='tel:+506 2537 0505'>+506 2537 0505</a></p>
                                                                        </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table border='0' cellpadding='0' cellspacing='0' class='social_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                                    <tr>
                                                                        <td style='padding-bottom:10px;padding-left:30px;padding-right:30px;padding-top:30px;text-align:center;'>
                                                                            <table align='center' border='0' cellpadding='0' cellspacing='0' class='social-table' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='180px'>
                                                                                <tr>
                                                                                    <td style='padding:0 2px 0 2px;'><a href='https://es-la.facebook.com/covaodiurno/' target='_blank'><img alt='Facebook' height='32' src='images/facebook2x.png' style='display: block; height: auto; border: 0;' title='facebook' width='32'/></a></td>
                                                                                    <td style='padding:0 2px 0 2px;'><a href='https://www.instagram.com/covao.diurno/' target='_blank'><img alt='Instagram' height='32' src='images/instagram2x.png' style='display: block; height: auto; border: 0;' title='instagram' width='32'/></a></td>
                                                                                    <td style='padding:0 2px 0 2px;'><a href='https://www.youtube.com/channel/UCLfrfTSgNqIrkKvYmNtwODg/featured' target='_blank'><img alt='YouTube' height='32' src='images/youtube2x.png' style='display: block; height: auto; border: 0;' title='YouTube' width='32'/></a></td>
                                                                                    <td style='padding:0 2px 0 2px;'><a href='https://covao.ed.cr/' target='_blank'><img alt='Web Site' height='32' src='images/website2x.png' style='display: block; height: auto; border: 0;' title='Web Site' width='32'/></a></td>
                                                                                    <td style='padding:0 2px 0 2px;'><a href='mailto:mailto:info_diurno@covao.ed.cr' target='_blank'><img alt='E-Mail' height='32' src='images/mail2x.png' style='display: block; height: auto; border: 0;' title='E-Mail' width='32'/></a></td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                                    <tr>
                                                                        <td style='padding-bottom:10px;padding-left:30px;padding-right:30px;padding-top:10px;'>
                                                                            <div style='color:#949494;direction:ltr;font-family:Nunito, Arial, Helvetica Neue, Helvetica, sans-serif;font-size:11px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;'>
                                                                                <p style='margin: 0;'><span style='font-family: inherit; background-color: transparent;'>© 2022 Hospicio de Huérfanos de Cartago. Todos los derechos reservados</span></p>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table><!-- End -->
            </body>
            </html>'";

            return $nuevoHtml;
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////