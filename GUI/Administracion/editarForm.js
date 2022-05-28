let data = true;

function actualizarEstado()
{
    let estado = $( '#formActivo' ).prop( 'checked' ) ? "activado" : "desactivado";

    $.post( "enlaceDelBL", { estadoConfiguracion: $( '#formActivo' ).prop( 'checked' ) }, function ( data )
    {
        $( "#toastContainer" ).html( `<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                        <div id="notificacion" class="toast align-items-center text-white ${data == true ? "bg-success" : "bg-danger"} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body">
                                                    ${data == true ? estado == "activado" ? "Formulario activado correctamente" : "Formulario desactivado correctamente" : estado == "activado" ? "Ocurrió un error al activar el formulario" : "Ocurrió un error al desactivar el formulario"}
                                                </div>
                                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>`);
        mostrarNotificacion();
    } );
}




function mostrarNotificacion()
{
    var notificacion = document.getElementById( 'notificacion' );
    var toast = new bootstrap.Toast( notificacion );
    toast.show();
}