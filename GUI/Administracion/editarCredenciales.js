let data = true;

function VerificarCorreo()
{
    let correoInput = $( '#email' ).val(); //se optiene el valor de la fecha inicial

        //ajax
        $.post( "../../BL/Usuario/ActualizarCredencial.php", { correoInput: correoInput}, function ( data )
        {
            $( "#contenedorNotificaciones" ).html( `<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                            <div id="notificacion" class="toast align-items-center text-white ${data == true ? "bg-success" : "bg-danger"} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body">
                                                        ${data == true ? "<b>El Correo</b> es válido" : "El correo actual ya <b>existe</b>"}
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