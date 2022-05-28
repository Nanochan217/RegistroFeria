let data = true;

//actualizar los datos de disponibilidad del formulario
function actualizarDisponibilidad( campo )
{
    //si se va a desactivar el formulario
    if ( campo == 'estadoConfiguracion' )
    {
        let estadoConfiguracion = $( '#estadoConfiguracion' ).prop( 'checked' ); //se optiene si el checkbox está marcado o no
        estadoConfiguracion ? estadoConfiguracion = 1 : estadoConfiguracion = 0; //se cambia de true a 1, y de false a 0

        //ajax
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
    //si se va a cambiar la fecha inicial del formulario
    else if ( campo == 'fechaInicial' )
    {
        let fechaInicial = $( '#fechaInicio' ).val(); //se optiene el valor de la fecha inicial

        //ajax
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
    //si se va a cambiar la fecha final del formulario
    else if ( campo == 'fechaFinal' )
    {
        let fechaFinal = $( '#fechaFinal' ).val(); //se optiene el valor de la fecha inicial

        //ajax
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

//actualizar el numeor máximo de acompañantes por persona
function actualizarAcompanantes()
{
    let acompanantesMaximo = Math.abs( parseInt( $( '#acompanantesMaximo' ).val(), 10 ) ); //se obtiene el valor, se convierte a entero, y se elimina el negativo en caso de tenerlo

    //si el valor es diferente a NaN
    if ( isNaN( acompanantesMaximo ) !== true )
    {
        $( '#acompanantesMaximo' ).val( acompanantesMaximo ); //se actualiza el valor en el input

        //ajax
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
    //si el valor es Nan
    else if ( isNaN( acompanantesMaximo ) === true )
    {
        $( '#acompanantesMaximo' ).val( 0 ); //se cambia el valor del input a 0
    }
}

//actualiza los diferentes datos del dia
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
        $( `#${elementoID}` ).val( diaVisible );

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
            if ( data )
            {
                cambiarBtnDiaVisible( elementoID, diaVisible );
            }
        } );
    }
    else if ( campo == 'actualizarDiaActive' )
    {
        let diaActive = $( `#${elementoID}` ).val();
        diaActive == 1 ? diaActive = 0 : diaActive = 1;

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
            eliminarDia( elementoID );
        } );
    }
}

//actualiza los diferentes datos del horario
function actualizarHorario( idHorario, elementoID, campo )
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
        $( `#${elementoID}` ).val( diaVisible );

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
            if ( data )
            {
                cambiarBtnDiaVisible( elementoID, diaVisible );
            }
        } );
    }
    else if ( campo == 'actualizarDiaActive' )
    {
        let diaActive = $( `#${elementoID}` ).val();
        diaActive == 1 ? diaActive = 0 : diaActive = 1;

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
            eliminarDia( elementoID );
        } );
    }
}

function cambiarBtnDiaVisible( id, estado )
{
    estado == 1 ? $( `#${id}` ).removeClass( "btn-secondary" ).addClass( "btn-light" ) && $( `#${id}` ).html( `<i id="${id}Icono" style="font-size: 18px; " class="bi bi-eye"></i>` ) : $( `#${id}` ).removeClass( "btn-light" ).addClass( "btn-secondary" ) && $( `#${id}` ).html( `<i id="${id}Icono" style="font-size: 18px; " class="bi bi-eye-slash"></i>` );
}

function eliminarDia( id )
{
    let pattern = /\d+/;
    let nuevoId = id.match( pattern );

    $( `#diaUsuario${nuevoId}` ).remove();
}

function mostrarNotificacion()
{
    var notificacion = document.getElementById( 'notificacion' );
    var toast = new bootstrap.Toast( notificacion );
    toast.show();
}