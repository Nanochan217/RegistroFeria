<?php
session_start();
$header = file_get_contents('../Default/Header.html');
$headerSA = file_get_contents('../Default/HeaderSA.html');
$headerA = file_get_contents('../Default/HeaderA.html');
$footer = file_get_contents('../Default/Footer.html');
$cssLinks = file_get_contents('../Default/CSSImports.html');
$jsLinks = file_get_contents('../Default/JSImports.html');
$cssDefault = file_get_contents('../Default/Style.css');

include '../../BL/Cita/BuscarTodosDatos.php';
?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- IMPORT CSS -->
    <?php
    echo $cssLinks;
    ?>

    <title>Registrarse a la feria</title>
    <!-- START CSS  -->
    <style>
        <?php
        echo $cssDefault;
        ?>@media (max-width: 768px) {
            #textoEliminar {
                display: inline !important;
                margin-top: 10px;
            }
        }

        .form-check-input.is-valid:checked,
        .was-validated .form-check-input:valid:checked {
            background-color: #0d6efd !important;
        }

        .form-check-input.is-valid,
        .was-validated .form-check-input:valid {

            border-color: #0000002d;
        }

        .form-check-input.is-valid~.form-check-label,
        .was-validated .form-check-input:valid~.form-check-label {
            color: #212529;
        }
    </style>
    <!-- END CSS  -->
</head>

<body class="bg-light" onload="cargarDias(), cargarColegios()">

    <?php
    if ($_SESSION["Perfil"] == 1)
    {
        echo $headerSA;
    }
    else if ($_SESSION["Perfil"] == 2)
    {
        echo $headerA;
    }
    else
    {
        echo $header;
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- Titulo de la pagina -->
                <div class="pt-5 pb-4">
                    <h1 class="text-center">Reservar Cita</h1>
                    <div class="alert alert-warning text-center small my-3 py-1 mx-auto" style="width: fit-content;" role="alert">
                        Fecha maxima para reservar: <span class="fw-bold" id="fechaMaxima"></span>
                    </div>
                </div>

                <!-- Formulario START-->
                <form action="../../BL/Cita/NuevaCita.php" method="POST" id="form" class="row gap-3 needs-validation" novalidate>

                    <!-- START Sección de datos del solicitante -->
                    <div class="row border rounded bg-white shadow-sm p-5">
                        <h2 class="pb-4">Datos del solicitante</h2>

                        <!-- Imputs 1 -->
                        <div class="row">

                            <!-- Cedula -->
                            <div class="col-md-3 pb-3">
                                <label for="cedula" class="form-label">Cédula</label>
                                <input type="text" class="form-control " id="cedula" name="asistente[cedula]" onfocusout="validarSolicitante('cedula')" required>
                                <div class="invalid-feedback" id="cedulaVacia">
                                    Digite su cédula.
                                </div>
                                <div class="text-danger small" id="validarCedula" style="display: none;">
                                    Esta cedula ya está asociada a otra cita.
                                </div>
                            </div>

                            <!-- Nombre -->
                            <div class="col-md-3 pb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="asistente[nombre]" required>
                                <div class="invalid-feedback">
                                    Digite su nombre.
                                </div>
                            </div>

                            <!-- Apellido 1 -->
                            <div class="col-md-3 pb-3">
                                <label for="apellido1" class="form-label">Primer apellido</label>
                                <input type="text" class="form-control " id="apellido1" name="asistente[apellido1]" required>
                                <div class="invalid-feedback">
                                    Digite su primer apellido.
                                </div>
                            </div>

                            <!-- Apellido 2 -->
                            <div class="col-md-3 pb-3">
                                <label for="apellido2" class="form-label">Segundo apellido</label>
                                <input type="text" class="form-control " id="apellido2" name="asistente[apellido2]" required>
                                <div class="invalid-feedback">
                                    Digite su segundo apellido.
                                </div>
                            </div>
                        </div>

                        <!-- Imputs 2 -->
                        <div class="row">
                            <!-- Correo -->
                            <div class="col-md-4 pb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control " id="email" name="asistente[correo]" onfocusout="validarSolicitante('email')" required>
                                <!-- <div class="invalid-feedback" id="validarEmail">
                                    Este email ya está asociado a otra cita.
                                </div> -->
                                <div class="invalid-feedback">
                                    Digite su correo electrónico.
                                </div>
                            </div>

                            <!-- Telefono -->
                            <div class="col-md-4 pb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control " id="telefono" name="asistente[telefono]" min="0" minlength="8" onfocusout="validarSolicitante('telefono')" required>
                                <!-- <div class="invalid-feedback" id="validarTelefono">
                                    Este telefono ya está asociado a otra cita.
                                </div> -->
                                <div class="invalid-feedback">
                                    Digite su número telefónico.
                                </div>
                            </div>

                            <!-- Colegio de procedencia -->
                            <div class="col-md-4 pb-3">
                                <label for="colegioProcedencia" class="form-label">Colegio de Procedencia</label>
                                <select id="colegioProcedencia" name="asistente[idColegioProcedencia]" class="form-select" required>
                                    <option value="" selected disabled hidden>Seleccione un colegio</option>
                                    <option value="otro">Otro</option>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione su colegio de procedencia.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Sección de datos del solicitante -->

                    <div class="row gap-3 p-0">

                        <!-- START Sección de fecha de la cita -->
                        <div class="col-md border rounded shadow-sm bg-white p-5">
                            <h2 class="pb-4">Fecha de la cita</h2>

                            <!-- Inputs -->
                            <div class="row">

                                <!-- Día -->
                                <div class="col-md-6 pb-3">
                                    <label for="diaCita" class="form-label">Día</label>
                                    <select id="diaCita" class="form-select" oninput="cargarHorarios(this.value)" required>
                                        <option value="" selected disabled hidden>Seleccione un día</option>
                                    </select>
                                    <input type="hidden" name="cita[fechaCita]">
                                    <div class="invalid-feedback">
                                        Seleccione un día.
                                    </div>
                                </div>

                                <!-- Hora -->
                                <div class="col-md-6 pb-3">
                                    <label for="horarioCita" class="form-label">Horario</label>
                                    <select id="horarioCita" class="form-select" oninput="llenarHiddenHorario()" required disabled> <!-- procesooooooooooooooooooooooooooooooiooiooo -->
                                        <option value="" selected disabled hidden>Seleccione un dia primero</option>
                                    </select>
                                    <input type="hidden" name="cita[horario]">
                                    <div class="invalid-feedback">
                                        Seleccione un horario.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Sección de fecha de la cita -->

                        <!-- START Sección de acompañantes -->
                        <div class="col-md border rounded shadow-sm bg-white p-5">
                            <div class="d-flex gap-3 flex-wrap pb-4">
                                <h2>Acompañantes <span class="text-muted h5">máx(<span id="maxAcompanantesTitulo"></span>)</span></h2>

                                <!-- Radio Buttons -->
                                <div class="d-flex gap-4 pt-2">
                                    <!-- Si -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="acompanante" id="acompananteSI" onclick="alternarAcompanantes('si')">
                                        <label class="form-check-label" for="acompananteSI">Sí</label>
                                    </div>

                                    <!-- No -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="acompanante" id="acompananteNo" onclick="alternarAcompanantes('no')" checked>
                                        <label class="form-check-label" for="acompananteNo">No</label>
                                    </div>
                                </div>
                            </div>

                            <div id="acompanantes">

                            </div>

                            <!-- Button Agregar acompañante -->
                            <div class="d-grid gap-2" id="addAcompanante" style="display:none !important;">
                                <button class="btn btn-outline-primary" type="button" id="acompananteAddBtn" onclick="crearAcompanate()"><i class="bi bi-plus-circle align-middle lh-1 me-2" style="font-size: 18px;"></i>Agregar acompanante</button>
                            </div>

                            <div class="alert alert-secondary" id="acompananteMsj" role="alert">
                                No asistirás con ningún acompañante
                            </div>
                        </div> <!-- END Sección de acompañantes -->

                    </div>

                    <div class="row gap-3 p-0">
                        <div class="col position-relative px-0 py-5">
                            <div class="d-flex gap-3 position-absolute top-0 end-0">
                                <a href="../Index/Index.php" class="btn btn-danger">Descartar</a>
                                <!-- <a type="submit" href="../../BL/Cita/NuevaCita.php" class="btn btn-primary">Enviar Reserva</a> -->
                                <button type="submit" id="enviarForm" class="btn btn-primary">Enviar Reserva</button>
                            </div>
                        </div>
                    </div>

                </form>
                <!-- Formulario END -->

            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" id="btnNotificacion" hidden></button>
    <div class="toast-container" id="contenedorNotificaciones"></div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" style="display: none;" id="btnModal" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content bg-transparent">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-white">
                    <div class="d-flex flex-column gap-3 align-content-center">
                        <p>
                            Haz digitado una misma cédula para varios acompañantes. Asegurate de que todos los acompañantes tengan una cédula distinta.
                        </p>
                    </div>
                </div>
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!--  Footer  -->
    <?php
    echo $footer;
    ?>

    <!-- START Scripts  -->
    <?php
    echo $jsLinks;;
    ?>
    <script>
        // $(document).ready(function() {
        //     $("form").submit(function(event) {
        //         e.preventDefault(); // avoid to execute the actual submit of the form.

        //         var form = $(this);
        //         var actionUrl = form.attr('action');


        //         $.ajax({
        //             type: "POST",
        //             url: actionUrl,
        //             data: form.serialize(), // serializes the form's elements.
        //         }).done(function(data) {
        //             console.log(data);
        //         });

        //         event.preventDefault();
        //     });
        // });


        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = $('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        event.preventDefault()
                        event.stopPropagation()

                        let form1 = $('form');
                        console.log(form1.serialize())
                        var actionUrl = form.getAttribute('action');

                        $.ajax({
                            type: "POST",
                            url: actionUrl,
                            data: form1.serialize(), // serializes the form's elements.
                        }).done(function(data) {
                            console.log(data);
                        });
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()

        var acompanantes = [];
        contadorAcompanante = 0;

        var configuracion = <?php echo BuscarConfiguracion() ?>;
        var dias = <?php echo BuscarDias() ?>;
        var horarios = <?php echo BuscarHorarios() ?>;
        var colegios = <?php echo BuscarTodosColegios() ?>;
        // var parentescos = <?php ?>
        var fecha = [];

        let fechaMaxima = formatearDia(configuracion[0].fechaFinal)
        fechaMaxima = `${fechaMaxima[0]} ${fechaMaxima[1]} de ${fechaMaxima[2]}`
        $("#fechaMaxima").html(fechaMaxima)

        $("#maxAcompanantesTitulo").html(configuracion[0].acompanateMax)



        function cargarDias() {
            dias.forEach(dia => {
                if (dia.visible == 1 && dia.active == 1) {
                    let fecha = formatearDia(dia.dia);
                    $("#diaCita").append(`<option value="${dia.id}">${fecha[0]} ${fecha[1]} de ${fecha[2]}</option>`)
                }
            });
        }

        function cargarColegios() {
            colegios.forEach(colegio => {
                if (colegio.active == 1) {
                    $("#colegioProcedencia").append(`<option value="${colegio.id}">${colegio.nombre}</option>`)
                }
            });
        }

        function formatearDia(fecha) {
            let diasSemana = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
            let mesAnio = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            let fechaNueva = new Date(fecha);

            return [diasSemana[fechaNueva.getDay()], fechaNueva.getDate() + 1, mesAnio[fechaNueva.getMonth()]]
        }

        function cargarHorarios(idDia) {
            let contadorHorarios = 0;
            $("#horarioCita").html("")
            $("#horarioCita").append(`<option value="" selected disabled hidden>Seleccione un horario</option>`)
            horarios.forEach(horario => {
                if (horario.idDiaHabil == idDia) {
                    $("#horarioCita").append(`<option value="${horario.id}">${horario.horaInicio} - ${horario.horaFinal}</option>`)
                    $("#horarioCita").prop("disabled", false);
                    contadorHorarios++;
                }
            });
            if (contadorHorarios == 0) {
                $("#horarioCita").prop("disabled", true);
                $("#horarioCita").html("")
                $("#horarioCita").append(`<option value="none" selected disabled hidden>Sin horarios disponibles</option>`)
            }
        }

        ///////////////////////////////////////////////////////////////////////////////////////////

        function alternarAcompanantes(alternar) {
            if (alternar === 'si') {
                if (acompanantes.length == 0) {
                    crearAcompanate();
                    $("#acompananteMsj").hide();
                    $("#addAcompanante").attr('style', 'display: grid !important;');
                }
            } else if (alternar === 'no') {
                acompanantes = [];
                $("#acompananteMsj").show();
                $("#addAcompanante").attr('style', 'display: none !important;');
                $('#acompanantes').html('');
            }
        }

        function crearAcompanate() {
            if (acompanantes.length < configuracion[0].acompanateMax) {
                contadorAcompanante++
                let acompanante = {
                    "id": contadorAcompanante,
                    "cedula": null,
                    "nombre": null,
                    "idTipoAcompanante": null
                };

                acompanantes.push(acompanante);
                mostrarAcompanante(acompanante);
            } else {
                $("#contenedorNotificaciones").html(`<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                            <div id="notificacion" class="toast align-items-center  bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body">
                                                        Haz alcanzado el número máximo de acompañantes
                                                    </div>
                                                    <button type="button" class="btn-close  me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>`);
                mostrarNotificacion();

            }
        }

        function mostrarAcompanante(acompanante) {
            let contenedor = `<div class="row mb-3 mx-0 p-3 gx-3 gapx-4 bg-light border rounded" id="acompanante${acompanante.id}">
                        <div class="col-md-6 mt-0">
                            <label for="acompananteCedula${acompanante.id}" class="form-label">Cédula</label>
                            <input type="text" class="form-control cedulaAcompanante" id="acompananteCedula${acompanante.id}" name="acompanantes[${acompanante.id}][cedula]" onfocusout="validarAcompanantes('cedula', ${acompanante.id})" required>
                            <div class="invalid-feedback" id="cedulaVacia">
                                Digite una cédula.
                            </div>
                            <div class="text-danger small" id="validarCedulaAcompanante${acompanante.id}" style="display: none;">
                                Esta cedula ya está asociada a otra cita.
                            </div>
                        </div>
                        <div class="col-md-6 mt-0">
                            <label for="acompananteNombre${acompanante.id}" class="form-label ">Nombre</label>
                            <input type="text" class="form-control" id="acompananteNombre${acompanante.id}" name="acompanantes[${acompanante.id}][nombre]" required>
                            <div class="invalid-feedback" id="cedulaVacia">
                                Digite un nombre.
                            </div>
                        </div>
                        <div class="col-md-6 mt-0">
                            <label for="acompananteTipo${acompanante.id}" class="form-label ">Parentesco</label>
                            <select class="form-select" id="acompananteTipo${acompanante.id}" name="acompanantes[${acompanante.id}][idTipoAcompanante]" required>
                                <option value="" selected disabled hidden>Seleccione un parentesco</option>
                                <option value="1" >1</option>
                            </select>
                            <div class="invalid-feedback" id="cedulaVacia">
                                Digite un parentesco.
                            </div>
                        </div>
                        <div class="col-md-6 mt-0">
                            <div class="d-flex flex-column">
                                <label for="acompananteTipo${acompanante.id}" class="form-label ">Eliminar acompañante</label>
                                <button class="btn btn-danger py-1 px-3" type="button" id="acompananteTipo${acompanante.id}" value="${acompanante.id}" onclick="borrarAcompanante(this.value)"><i style="font-size: 18px; " class="bi bi-trash3"></i></button>
                            </div>
                        </div>
                    </div>`;

            $("#acompanantes").append(contenedor);

        }

        function borrarAcompanante(idAcompanante) {
            $.each(acompanantes, (index, acompanante) => {
                console.log(acompanante);
                if (idAcompanante == acompanante.id) {
                    acompanantes.splice(index, 1);
                    return false;
                }
            });

            $(`#acompanante${idAcompanante}`).remove();
            console.table(acompanantes);
        }

        function mostrarNotificacion() {
            var notificacion = document.getElementById('notificacion');
            var toast = new bootstrap.Toast(notificacion);
            toast.show();
        }

        ////////////////////////////////////////////////////////////////////////////

        function validarSolicitante(campo) {
            if (campo == 'cedula') {
                let cedula = $('#cedula').val(); //se optiene el valor de la cedula

                //ajax
                $.post("../../BL/Cita/ValidacionAsistente.php", {
                    cedula: cedula,
                    campo: campo
                }, function(data) {
                    if (data == 1) {
                        $('#validarCedula').hide()
                        $('#cedula').removeClass('is-invalid');
                        $('#cedula').css({
                            "border-color": "#198754",
                            "padding-right": "calc(1.5em + .75rem)",
                            "background-image": `url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e")`,
                            "background-repeat": "no-repeat",
                            "background-position": "right calc(.375em + .1875rem) center",
                            "background-size": "calc(.75em + .375rem) calc(.75em + .375rem)",
                        });

                    } else {
                        $('#validarCedula').show()
                        $('#cedula').removeClass('is-invalid');
                        $('#cedula').css({
                            "border-color": "#dc3545",
                            "padding-right": "calc(1.5em + .75rem)",
                            "background-image": `url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e")`,
                            "background-repeat": "no-repeat",
                            "background-position": "right calc(.375em + .1875rem) center",
                            "background-size": "calc(.75em + .375rem) calc(.75em + .375rem)",

                        });
                    }
                });

            } else if (campo == 'email') {
                let email = $('#email').val(); //se optiene el valor de la email

                //ajax
                $.post("../../BL/Cita/ValidacionAsistente.php", {
                    email: email,
                    campo: campo
                }, function(data) {
                    if (data == 1) {
                        $('#validarEmail').hide()
                        $('#email').removeClass('is-invalid')
                    } else {
                        $('#validarEmail').show()
                        $('#email').addClass('is-invalid')
                    }
                });
            } else if (campo == 'telefono') {
                let telefono = $('#telefono').val(); //se optiene el valor de la telefono

                //ajax
                $.post("../../BL/Cita/ValidacionAsistente.php", {
                    telefono: telefono,
                    campo: campo
                }, function(data) {
                    if (data == 1) {
                        $('#validartelefono').hide()
                        $('#telefono').removeClass('is-invalid')
                    } else {
                        $('#validartelefono').show()
                        $('#telefono').addClass('is-invalid')
                    }
                });
            }
        }

        function validarAcompanantes(campo, idAcompanante) {
            if (campo == 'cedula') {
                let cedula = $(`#acompananteCedula${idAcompanante}`).val(); //se optiene el valor de la cedula
                //ajax
                $.post("../../BL/Cita/ValidacionAcompanante.php", {
                    cedula: cedula,
                    campo: campo
                }, function(data) {
                    if (data == 1) {
                        $(`#validarCedulaAcompanante${idAcompanante}`).hide()
                        $(`#acompananteCedula${idAcompanante}`).removeClass('is-invalid');
                        $(`#acompananteCedula${idAcompanante}`).css({
                            "border-color": "#198754",
                            "padding-right": "calc(1.5em + .75rem)",
                            "background-image": `url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e")`,
                            "background-repeat": "no-repeat",
                            "background-position": "right calc(.375em + .1875rem) center",
                            "background-size": "calc(.75em + .375rem) calc(.75em + .375rem)",
                        });
                    } else {
                        $(`#validarCedulaAcompanante${idAcompanante}`).show()
                        $(`#acompananteCedula${idAcompanante}`).removeClass('is-invalid');
                        $(`#acompananteCedula${idAcompanante}`).css({
                            "border-color": "#dc3545",
                            "padding-right": "calc(1.5em + .75rem)",
                            "background-image": `url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e")`,
                            "background-repeat": "no-repeat",
                            "background-position": "right calc(.375em + .1875rem) center",
                            "background-size": "calc(.75em + .375rem) calc(.75em + .375rem)",

                        });
                    }
                });
            }
        }
    </script>
    <!-- END Scripts  -->
</body>

</html>