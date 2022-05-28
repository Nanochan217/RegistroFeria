function actualizarEstado()
{
    $.post( "enlaceDelBL", { estadoConfiguracion: $( '#formActivo' ).prop( 'checked' ) }, function ( data )
    {
        $( "$toastContainer" ).html( `<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                        <div id="liveToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body">
                                                    Formulario activado correctamente
                                                </div>
                                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>`);
    } );
}

var toastTrigger = document.getElementById( 'liveToastBtn' );
var toastLiveExample = document.getElementById( 'liveToast' );
if ( toastTrigger )
{
    toastTrigger.addEventListener( 'click', function ()
    {
        var toast = new bootstrap.Toast( toastLiveExample );

        toast.show();
    } );
}