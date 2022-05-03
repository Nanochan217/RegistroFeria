<?php
//Librerias Necesarias
?>


<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Registrarse a la feria</title>
    <style>
        @media (max-width: 600px) {
            .feria {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-light">

<?php
include '../Default/Header.html';
?>
<for

<div class="container-sm py-5">
    <div class="row">
        <div class="col-4-md mx-auto bg-white rounded border p-5">
            <div class="d-flex gap-4 flex-wrap pb-4">
                <h1 class="">Reservar Cita</h1>
                <div class="text-center alert alert-warning mt-2 mb-3 py-1" role="alert">
                    Fecha maxima de registro: <span class="fw-bold" id="fechaMaxima">Lunes 1 de Noviembre</span>

                </div>
            </div>
            <form class="row g-3">
                <h2>Datos del solicitante</h2>
                <div class="col-md-3">
                    <label for="cedula" class="form-label">Cedula</label>
                    <input type="text" class="form-control" id="cedula" name="cedula">
                </div>
                <div class="col-md-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="col-md-3">
                    <label for="apellido1" class="form-label">Primer apellido</label>
                    <input type="text" class="form-control" id="apellido1" name="apellido1">
                </div>
                <div class="col-md-3">
                    <label for="apellido2" class="form-label">Segundo apellido</label>
                    <input type="text" class="form-control" id="apellido2" name="apellido2">
                </div>
                <div class="col-md-4">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="col-md-4">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="Number" class="form-control" id="telefono" name="telefono">
                </div>
                <div class="col-md-4">
                    <label for="colegioProcedencia" class="form-label">Colegio de Procedencia</label>
                    <select id="colegioProcedencia" name="colegioProcedencia" class="form-select">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>

                <!--Acompañantes-->


                <div class="row pt-5 gap-4">
                    <div class="col-md">

                        <h2 class="pb-2">Fecha de la cita</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="parentescoAcompanante" class="form-label">Hora</label>
                                <select id="parentescoAcompanante" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="parentescoAcompanante" class="form-label">Hora</label>
                                <select id="parentescoAcompanante" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="col-md">
                        <div class="d-flex gap-3 flex-wrap">
                            <h2 class="pb-2">Acompañantes</h2>
                            <div class="d-flex gap-4 pt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Sí
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                           id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="cedulaAcompanante1" class="form-label">Cedula</label>
                                <input type="text" class="form-control" id="cedulaAcompanante1"
                                       name="cedulaAcompanante1">
                            </div>
                            <div class="col-md-6">
                                <label for="parentescoAcompanante" class="form-label">Parentesco</label>
                                <select id="parentescoAcompanante" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary mt-3" type="button">+ Agregar acompañante</button>
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>

            </form>

        </div>
    </div>
</div>
<!--  Footer  -->
<?php
include '../Default/Footer.html';
?>


<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPassRecoveryLabel">Editar Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="correoRecovery" class="form-label pb-3">Ingrese su correo electrónico y le enviaremos un
                        enlace con los pasos a realizar.
                    </label>
                    <input type="email" class="form-control" id="correoRecovery" name="correoRecovery"
                           placeholder="Ingrese su correo electrónico">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="Index.js"></script>
</body>
</html>