let data = true;

function actualizarDisponibilidad( campo )
{
    if ( campo == 'estadoConfiguracion' )
    {
        let estadoConfiguracion = $( '#estadoConfiguracion' ).prop( 'checked' );

        if ( estadoConfiguracion == false )//Habilitar
            var id = 0;
        else//Deshabilitar
            var id = 1;

        $.post( "../../BL/Configuracion/ModificarConfiguracion.php", { estadoConfiguracion: id, campo: campo }, function ( data )
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
        let fechaInicial = $( '#fechaInicio' ).val();

        $.post( "../../BL/Configuracion/ModificarConfiguracion.php", { fechaInicio: fechaInicial, campo: campo }, function ( data )
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

        $.post( "../../BL/Configuracion/ModificarConfiguracion.php", { acompanantesMaximo: acompanantesMaximo, campo: "acompanantesMaximo" }, function ( data )
        {
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
        } );
    }
    else if ( isNaN( acompanantesMaximo ) === true )
    {
        $( '#acompanantesMaximo' ).val( 0 );
    }
}

function actualizarDia( idDia, elementoID, campo )
{
    if ( campo == 'actualizarDia' )
    {
        let dia = $( `#${elementoID}` ).val();

        $.post( "../../BL/Configuracion/ModificarDiaHabil.php", { id: idDia, dia: dia, campo: campo }, function ( data )
        {
            $( "#contenedorNotificaciones" ).html( `<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                            <div id="notificacion" class="toast align-items-center text-white ${data == true ? "bg-success" : "bg-danger"} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body">
                                                        ${data == true ? "<b>Día</b> actualizado correctamente" : "Ocurrió un error al intentar actualizar el día"}
                                                    </div>
                                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>`);
            mostrarNotificacion();
        } );
    }
    else if ( campo == 'actualizarDiaVisible' )
    {
        let diaVisible = $( `#${elementoID}` ).val();
        diaVisible == 1 ? diaVisible = 0 : diaVisible = 1;


        $.post( "../../BL/Configuracion/ModificarDiaHabil.php", { id: idDia, diaVisible: diaVisible, campo: campo }, function ( data )
        {
            $( "#contenedorNotificaciones" ).html( `<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                            <div id="notificacion" class="toast align-items-center text-white ${data == true ? "bg-success" : "bg-danger"} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body">
                                                        ${data == true ? "<b>Visibilidad del día</b> actualizada correctamente" : "Ocurrió un error al intentar actualizar la visibilidad del día "}
                                                    </div>
                                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>`);
            mostrarNotificacion();
        } );
    }
    else if ( campo == 'actualizarDiaActive' )
    {
        let diaActive = $( `#${elementoID}` ).val();
        diaActive == 1 ? diaActive = 0 : diaActive = 1;

        alert( diaActive );
        $.post( "../../BL/Configuracion/ModificarDiaHabil.php", { id: idDia, diaActive: diaActive, campo: campo }, function ( data )
        {
            $( "#contenedorNotificaciones" ).html( `<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                            <div id="notificacion" class="toast align-items-center text-white ${data == true ? "bg-success" : "bg-danger"} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body">
                                                        ${data == true ? "<b>Día</b> eliminado correctamente" : "Ocurrió un error al intentar eliminar el día "}
                                                    </div>
                                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>`);
            mostrarNotificacion();
        } );
    }
}

function mostrarNotificacion()
{
    var notificacion = document.getElementById( 'notificacion' );
    var toast = new bootstrap.Toast( notificacion );
    toast.show();
}