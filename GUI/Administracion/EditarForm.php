<?php
session_start();
if ($_SESSION['Perfil'] != 1)
    header("Location: ../PantallasDestino/AccesoDenegado.php");

$header = file_get_contents('../Default/Header.html');
$headerSA = file_get_contents('../Default/HeaderSA.html');
$footer = file_get_contents('../Default/Footer.html');
$cssLinks = file_get_contents('../Default/CSSImports.html');
$jsLinks = file_get_contents('../Default/JSImports.html');
$cssDefault = file_get_contents('../Default/Style.css');

include '../../BL/Configuracion/BuscarTodasConfiguraciones.php';

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

    <title>Editar Formulario</title>

    <!-- START CSS  -->
    <style>
        <?php
        echo $cssDefault;
        ?>
    </style>
    <!-- END CSS  -->
</head>

<body class="bg-light">

    <!-- IMPORT Header -->
    <?php
    echo $headerSA;
    ?>

    <div class="container py-5">
        <div class="row">
            <div class="col">

                <!-- START Encabezado de la pagina -->
                <div class="d-flex gap-4 flex-column align-items-center justify-content-center pb-4">
                    <h1>Editar Formulario</h1> <!-- titulo -->
                </div>
                <!-- END Encabezado de la pagina -->

                <form action="../../BL/Configuracion/ModificarConfiguracion.php" method="POST" class="row gap-3">

                    <div class="row gapx-4 border rounded bg-white shadow-sm p-5">
                        <div class="col-md-6">
                            <div class="d-flex ">
                                <h2 class="pb-4">Disponibilidad</h2>
                                <div class="form-check form-switch mt-2 ms-3 ">
                                    <input class="form-check-input" type="checkbox" role="switch" id="estadoConfiguracion" onclick="actualizarDisponibilidad('estadoConfiguracion')">
                                </div>
                            </div>
                            <div class="row g-3">
                                <input type="hidden" class="form-control" id="idConfiguracion" name="idConfiguracion" value="1"> <!-- idConfiguracion -->
                                <div class="col-md-5">
                                    <label for="fechaInicial" class="form-label">Fecha inicial</label>
                                    <input type="date" class="form-control" id="fechaInicio" value="2022-05-04" min="2022-05-04" max="2022-05-22" onchange="actualizarDisponibilidad('fechaInicial')" required>
                                </div>

                                <div class="col-md-5">
                                    <label for="fechaFinal" class="form-label">Fecha final</label>
                                    <input type="date" class="form-control" id="fechaFinal" value="2022-05-04" min="2022-05-04" max="2022-05-22" onchange="actualizarDisponibilidad('fechaFinal')" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="pb-4">Acompañantes</h2>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="maxAcompanantes" class="form-label">Maximo de acompañantes por persona</label>
                                    <input type="number" class="form-control" id="acompanantesMaximo" min="0" oninput="actualizarAcompanantes()" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gap-3 p-0">
                        <!-- dias -->
                        <div class="col-lg border rounded shadow-sm bg-white p-5">
                            <h2 class="pb-4">Días hábiles</h2>
                            <div id="diasHidden" display="none"></div>
                            <div id="dias"></div>
                            <!-- Button Agregar dia -->
                            <div class="d-grid gap-2" id="addDia">
                                <button class="btn btn-outline-primary" type="button" id="btnAddDia" onclick="agregarDia()"><i class="bi bi-plus-circle align-middle lh-1 me-2" style="font-size: 18px;"></i>Agregar día</button>
                            </div>
                        </div>
                        <!-- horarios -->
                        <div class="col-lg border rounded shadow-sm bg-white p-5" id="contenedorHorarios">
                            <h2 class="pb-4">Horarios</h2>
                            <div id="horariosHidden" display="none"></div>
                            <div id="horarios">
                                <div class="d-flex flex-column justify-content-center">
                                    <img src="../Assets/Images/seleccionarDia.svg" style="height:200px;">
                                    <h5 class="text-center mt-4 opacity-75">Seleccione un día para ver los horarios</h5>
                                </div>
                            </div>
                            <div class="d-grid gap-2" id="addHorario" style="display: none !important;">
                                <button class="btn btn-outline-primary" type="button" id="btnAddHorario" onclick="agregarHorario(idDia)"><i class="bi bi-plus-circle align-middle lh-1 me-2" style="font-size: 18px;"></i>Agregar horario</button>
                            </div>


                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" id="btnNotificacion" hidden></button>


    <div class="toast-container" id="contenedorNotificaciones"></div>




    <!-- IMPORT Footer  -->
    <?php
    echo $footer;
    ?>

    <!-- START Scripts  -->
    <?php
    echo $jsLinks;;
    ?>
    <Script>
        var configuracion = <?php echo BuscarConfiguraciones() ?>;

        var diasTemp = <?php echo BuscarDiasHabiles() ?>;
        var dias = diasTemp.map(function(dia) {
            dia.existe = true;
            return dia;
        });

        var horariosTemp = <?php echo BuscarHorarios() ?>;
        var horarios = horariosTemp.map(function(horario) {
            horario.existe = true;
            return horario;
        });

        var diaSeleccionado = false;

        var diasHidden = [];

        //contadores
        let contadorDiaShow = 0;
        let contadorDiaHide = 0;

        //dias y meses
        var diasSemana = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
        var mesesAnio = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

        $(document).ready(function() {

            //rellena los inputs con los datos provenientes de la BD
            $("#fechaInicio").val(configuracion[0].fechaInicio);
            $("#fechaFinal").val(configuracion[0].fechaFinal);
            $("#acompanantesMaximo").val(configuracion[0].acompanateMax);
            (configuracion[0].estadoFormulario == '1') ? $("#estadoConfiguracion").prop("checked", true): $("#estadoConfiguracion").prop("checked", false);

            //agrega los datos provenientes de la BD a inputs hidden
            dias.forEach(dia => {
                // agregarDiaInputHidden(dia)
                if (dia.active == 1) {
                    agregarDiaUsuario(dia)
                }
            });

            horarios.forEach(horario => {
                agregarHorarioInputHidden(horario);
            });

            tooltips();

            console.table(dias)
            console.table(horarios)

        });


        //agrega un dia al arreglo, inputs hidden y a la interfaz
        function agregarDia() {
            //se crea el dia
            let nuevoDia = {
                "id": UltimoID(dias),
                "dia": fechaHoy(),
                "idConfiguracion": "1",
                "visible": "1",
                "active": "1",
                "existe": false
            }

            agregarDiaArreglo(nuevoDia); //se agrega al arreglo
            // agregarDiaInputHidden(nuevoDia); //se agrega en inputs hidden
            agregarDiaUsuario(nuevoDia); //se muestra en pantalla para el usuario
        }

        //obtener la fecha de hoy
        function fechaHoy() {
            var fecha = new Date();
            var mes = formatearNumero(fecha.getMonth() + 1); //meses (0-11)
            var dia = formatearNumero(fecha.getDate()); //dias (1-31)
            var anio = fecha.getFullYear();
            var fechaFormateada = anio + "-" + mes + "-" + dia;

            return fechaFormateada;
        }

        //formatea el numero agregando un 0 si el mes o dia son menores a 10
        function formatearNumero(n) {
            return (n < 10 ? '0' : '') + n;
        }

        //obtiene el ultimo ID del arreglo
        function UltimoID(arreglo) {
            let ultimoID;
            ultimoID = (parseInt(arreglo[arreglo.length - 1].id) + 1).toString();
            return ultimoID;
        }

        //agregar dia al arreglo
        function agregarDiaArreglo(dia) {
            dias[dias.length] = dia;
        }

        //agregar dia en inputs hidden
        // function agregarDiaInputHidden(dia) {
        //     let contenedor = `<div id="dia${dia.id}" hidden="true">
        //                         <input type="hidden" id="diaId${dia.id}" name="fechas[${(dia.id) - 1}][diaHabil][id]" value="${dia.id}">
        //                         <input type="hidden" id="diaDia${dia.id}" name="fechas[${(dia.id) - 1}][diaHabil][dia]" value="${dia.dia}">
        //                         <input type="hidden" id="diaIdConfiguracion${dia.id}" name="fechas[${(dia.id) - 1}][diaHabil][idConfiguracion]" value="${dia.idConfiguracion}">
        //                         <input type="hidden" id="diaVisible${dia.id}" name="fechas[${(dia.id) - 1}][diaHabil][visible]" value="${dia.visible}">
        //                         <input type="hidden" id="diaActive${dia.id}" name="fechas[${(dia.id) - 1}][diaHabil][active]" value="${dia.active}">
        //                         <input type="hidden" id="diaExiste${dia.id}" name="fechas[${(dia.id) - 1}][diaHabil][existe]" value="${dia.existe}">
        //                     </div>`

        //     $('#diasHidden').append(contenedor);
        // }

        //agregar dia a la interfaz
        function agregarDiaUsuario(dia) {
            let contenedor = `<div class="row mx-0 p-3 gx-3 gapx-4 bg-light border rounded mb-3" id="diaUsuario${dia.id}">
                                <div class="col-md-8 mt-0">
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="dia${dia.id}" value="${dia.dia}" oninput="actualizarDia(${dia.id}, this.id, 'actualizarDia')" required>
                                        <div class="input-group-text p-0">
                                            <label class="py-2 px-3 lh-1" for="seleccionarDia${dia.id}" style="cursor: pointer;">
                                            <input class="form-check-input mt-0" type="radio" id="seleccionarDia${dia.id}" name="diaSeleccionado" value="${(dia.id)}" onclick="idDia=${dia.id}, mostrarHorarios(this.value)" style="cursor: pointer;">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-0">
                                    <div class="d-flex flex-column">
                                        <div class="d-grid gap-2 g-2 d-md-block">
                                            <button class="btn ${(dia.visible==1) ? "btn-light" : "btn-secondary"} border py-1 px-3 me-md-2" type="button" id="diaVisible${dia.id}" value="${dia.visible}" onclick="actualizarDia(${dia.id}, this.id, 'actualizarDiaVisible')" data-bs-toggle="tooltip" data-bs-placement="top" title="Ocultar día">${(dia.visible==1) ? '<i id="diaVisible' + dia.id + 'Icono" style="font-size: 18px; " class="bi bi-eye"></i>' : '<i id="diaVisible' + dia.id + 'Icono" style="font-size: 18px; " class="bi bi-eye-slash"></i>'}</button>
                                            <button class="btn btn-danger py-1 px-3" type="button" id="diaActive${dia.id}" value="${dia.active}" onclick="actualizarDia(${dia.id}, this.id, 'actualizarDiaActive')" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar día"><i style="font-size: 18px; " class="bi bi-trash3"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>`

            $('#dias').append(contenedor);
            tooltips();
        }

        //eliminar de la interfaz y cambiar active de 1 a 0 en el arreglo y los input hidden
        function eliminar(id, arreglo) {
            dias.forEach(dia => {
                if (dia.id == id) {
                    dia.active = "0";
                    $(`#diaActive${id}`).val("0");
                    $(`#diaUsuario${id}`).remove();
                    eliminarHorarios(dia.id);
                }
            });
            console.table(dias)
            console.table(horarios)

        }

        function eliminarHorarios(idDia) {
            horarios.forEach(horario => {
                if (horario.idDiaHabil == idDia) {
                    eliminarHorario(horario.id);
                }
            });
        }

        function eliminarHorario(id) {
            horarios.forEach(horario => {
                if (horario.id == id) {
                    horario.active = "0";
                    $(`#horarioActive${id}`).val("0");
                    $(`#horarioUsuario${id}`).remove();
                }
            });
        }

        //eliminar de la interfaz y cambiar active de 1 a 0 en el arreglo y los input hidden


        //agrega un horario al arreglo, inputs hidden y a la interfaz
        function agregarHorario(idDiaHabil) {
            //se crea el horario
            let nuevoHorario = {
                "id": UltimoID(horarios),
                "horaInicio": horaHoy(),
                "horaFinal": horaHoy(),
                "aforoMaximo": '300',
                "idDiaHabil": `${idDiaHabil}`, //en proceso
                "visible": "1",
                "active": "1",
                "existe": false
            }

            agregarHorarioArreglo(nuevoHorario); //se agrega al arreglo
            agregarHorarioInputHidden(nuevoHorario); //se agrega en inputs hidden
            agregarHorarioUsuario(nuevoHorario); //se muestra en pantalla para el usuario
            console.table(horarios)

        }

        //obtener la hora de hoy
        function horaHoy() {
            var fecha = new Date();
            var hora = formatearNumero(fecha.getHours()) + ":00:00";

            return hora;
        }

        //agregar horario al arreglo
        function agregarHorarioArreglo(horario) {
            horarios[horarios.length] = horario;
        }

        //agregar horario en inputs hidden
        function agregarHorarioInputHidden(horario) {
            let contenedor = `<div id="horario${horario.id}" hidden="true">
                                <input type="hidden" id="horarioId${horario.id}" name="fechas[${(horario.idDiaHabil) - 1}][horario][${(horario.id) - 1}][id]" value="${horario.id}">
                                <input type="hidden" id="horarioHoraInicio${horario.id}" name="fechas[${(horario.idDiaHabil) - 1}][horario][${(horario.id) - 1}][horaInicio]" value="${horario.horaInicio}">
                                <input type="hidden" id="horarioHoraFinal${horario.id}" name="fechas[${(horario.idDiaHabil) - 1}][horario][${(horario.id) - 1}][horaFinal]" value="${horario.horaFinal}">
                                <input type="hidden" id="horarioAforoMaximo${horario.id}" name="fechas[${(horario.idDiaHabil) - 1}][horario][${(horario.id) - 1}][aforoMaximo]" value="${horario.aforoMaximo}">
                                <input type="hidden" id="horarioIdDiaHabil${horario.id}" name="fechas[${(horario.idDiaHabil) - 1}][horario][${(horario.id) - 1}][idDiaHabil]" value="${horario.idDiaHabil}">
                                <input type="hidden" id="horarioVisible${horario.id}" name="fechas[${(horario.idDiaHabil) - 1}][horario][${(horario.id) - 1}][visible]" value="${horario.visible}">
                                <input type="hidden" id="horarioActive${horario.id}" name="fechas[${(horario.idDiaHabil) - 1}][horario][${(horario.id) - 1}][active]" value="${horario.active}">
                                <input type="hidden" id="horarioExiste${horario.id}" name="fechas[${(horario.idDiaHabil) - 1}][horario][${(horario.id) - 1}][existe]" value="${horario.existe}">
                            </div>`

            $('#horariosHidden').append(contenedor);
        }

        //agregar horario a la interfaz
        function agregarHorarioUsuario(horario) {
            let contenedor = `<div class="row mb-3 mx-0 p-3 gx-3 gapx-4 bg-light border rounded" id="horarioUsuario${horario.id}">
                                
                                <div class="col-md-6 mt-0">
                                    <div class="row mx-0 mb-4">
                                        <label for="inputHoraInicial${horario.id}" class="form-label">Hora inicial</label>
                                        <input type="time" class="form-control" id="inputHoraInicio${horario.id}" value="${horario.horaInicio}" oninput="actualizarHorarioInputHidden(${horario.id}, 'HoraInicio')" required>
                                    </div>
                                    <div class="row mx-0">
                                        <label for="inputHoraFinal${horario.id}" class="form-label">Hora final</label>
                                        <input type="time" class="form-control" id="inputHoraFinal${horario.id}" value="${horario.horaFinal}" oninput="actualizarHorarioInputHidden(${horario.id}, 'HoraFinal')" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mt-0">
                                    <div class="row mx-0  mb-4">
                                        <label for="inputAforo${horario.id}" class="form-label">Aforo máximo</label>
                                        <input type="number" class="form-control" id="inputAforoMaximo${horario.id}" value="${horario.aforoMaximo}" oninput="actualizarHorarioInputHidden(${horario.id}, 'AforoMaximo')" required>
                                    </div>
                                    <div class="row mx-0">
                                        <div class="d-flex flex-column">
                                        <label for="horaFinal1" class="form-label">Acciones</label>
 
                                        <div class="d-flex flex-wrap gap-3">
                                            <div class="d-flex flex-column">
                                                <button class="btn ${(horario.visible==1) ? "btn-light" : "btn-secondary"} border py-1 px-3" type="button" id="ocultarHorario${horario.id}" value="${horario.id}" onclick="ocultar(this.value, horarios, 'horario')">${(horario.visible==1) ? '<i id="iconoOcultarHorario' + horario.id + '" style="font-size: 18px; " class="bi bi-eye"></i>' : '<i id="iconoOcultarHorario' + horario.id + '" style="font-size: 18px; " class="bi bi-eye-slash"></i>'}</button>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <button class="btn btn-danger py-1 px-3" type="button" id="eliminarHorario${horario.id}" value="${horario.id}" onclick="eliminarHorario(this.value, horarios)"><i style="font-size: 18px; " class="bi bi-trash3"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>`

            $('#horarios').append(contenedor);
            tooltips();
        }

        //mostrar los horarios dependiendo del dia seleccionado
        function mostrarHorarios(idDia) {
            $('#horarios').html(''); //limpiar contenido
            horarios.forEach(horario => {
                if (horario.idDiaHabil == idDia && horario.active == 1) {
                    agregarHorarioUsuario(horario)
                }
            });

            $('#addHorario').show();
        }

        // function actualizarDiaInputHidden(id) {
        //     $(`#diaDia${id}`).val($(`#inputDia${id}`).val());
        // }

        // function actualizarHorarioInputHidden(id, propiedad) {
        //     $(`#horario${propiedad}${id}`).val($(`#input${propiedad}${id}`).val());
        // }
    </Script>

    <script>
        function tooltips() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        }
    </script>
    <script src="./editarForm.js"></script>
    <!-- END Scripts  -->
</body>

</html>