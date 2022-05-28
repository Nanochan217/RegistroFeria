let data = true;

function actualizarDisponibilidad( campo )
{
    if ( campo == 'estadoConfiguracion' )
    {
        let estadoConfiguracion = $( '#estadoConfiguracion' ).prop( 'checked' );

        $.post( "../../BL/Configuracion/ModificarConfiguracion.php", { estadoConfiguracion: estadoConfiguracion, campo: campo }, function ( data )
        {
            $( "#contenedorNotificaciones" ).html( `<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                            <div id="notificacion" class="toast align-items-center text-white ${data == true ? "bg-success" : "bg-danger"} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body">
                                                        ${data == true ? estadoConfiguracion == true ? "Formulario <b>activado</b> correctamente" : "Formulario <b>desactivado</b> correctamente" : estadoConfiguracion == false ? "Ocurrió un error al intentar activar el formulario" : "Ocurrió un error al intentar desactivar el formulario"}
                                                    </div>
                                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>`);
            mostrarNotificacion();
        } );
    }
    else if ( campo == 'fechaInicial' )
    {
        let fechaInicial = $( '#fechaInicial' ).val();

        $.post( "../../BL/Configuracion/ModificarConfiguracion.php", { fechaInicial: fechaInicial, campo: campo }, function ( data )
        {
            $( "#contenedorNotificaciones" ).html( `<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                            <div id="notificacion" class="toast align-items-center text-white ${data == true ? "bg-success" : "bg-danger"} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body">
                                                        ${data == true ? "<b>Fecha inicial</b> actualizada correctamente" : "Ocurrió un error al intentar actualizar la fecha inicial"}
                                                    </div>
                                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>`);
            mostrarNotificacion();
        } );
    }
    else if ( campo == 'fechaFinal' )
    {
        let fechaFinal = $( '#fechaFinal' ).val();

        $.post( "../../BL/Configuracion/ModificarConfiguracion.php", { fechaFinal: fechaFinal, campo: campo }, function ( data )
        {
            $( "#contenedorNotificaciones" ).html( `<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                            <div id="notificacion" class="toast align-items-center text-white ${data == true ? "bg-success" : "bg-danger"} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body">
                                                        ${data == true ? "<b>Fecha final</b> actualizada correctamente" : "Ocurrió un error al intentar actualizar la fecha final"}
                                                    </div>
                                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>`);
            mostrarNotificacion();
        } );
    }
}

function actualizarAcompanantes()
{
    let acompanantesMaximo = Math.abs( parseInt( $( '#acompanantesMaximo' ).val(), 10 ) );

    if ( isNaN( acompanantesMaximo ) !== true )
    {
        $( '#acompanantesMaximo' ).val( acompanantesMaximo );
        console.log( acompanantesMaximo );
        acompanantesMaximo = Math.abs( parseInt( acompanantesMaximo, 10 ) );
        // alert( acompanantesMaximo );
        // $.post( "enlaceDelBL", { acompanantesMaximo: acompanantexsMaximo }, function ( data )
        // {
        $( "#contenedorNotificaciones" ).html( `<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                            <div id="notificacion" class="toast align-items-center text-white ${data == true ? "bg-success" : "bg-danger"} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body">
                                                        ${data == true ? "<b>Numero máximo de acompañantes</b> actualizado correctamente" : "Ocurrió un error al intentar actualizar el número máximo de acompañantes"}
                                                    </div>
                                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>`);
        mostrarNotificacion();
        // } );
    }
    else if ( isNaN( acompanantesMaximo ) === true )
    {
        $( '#acompanantesMaximo' ).val( 0 );
    }
}

function mostrarNotificacion()
{
    var notificacion = document.getElementById( 'notificacion' );
    var toast = new bootstrap.Toast( notificacion );
    toast.show();
}