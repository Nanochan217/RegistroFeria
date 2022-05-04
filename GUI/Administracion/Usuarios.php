<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- IMPORT CSS -->
    <?php
    include '../Default/CSSImports.html';
    ?>

    <title>Usuarios</title>

    <!-- START CSS  -->
    <style>
        <?php
        include '../Default/Style.css';
        ?>
    </style>
    <!-- END CSS  -->
</head>

<body class="bg-light">

    <!-- IMPORT Header -->
    <?php
    include '../Default/HeaderLogged.html';
    ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- START Encabezado de la pagina -->
                <div class="d-flex gap-4 flex-column align-items-center justify-content-center pt-5 pb-4">
                    <h1>Usuarios</h1> <!-- titulo -->
                </div>
                <!-- END Encabezado de la pagina -->

                <div class="row border rounded bg-white shadow-sm p-5 mb-5">
                    <div class="row gap-3 justify-content-between my-3">
                        <div class="col-auto">
                            <select id="filtrarDia" name="filtrarDia" class="form-select">
                                <option value="none" selected disabled hidden>Perfil</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <div class="d-flex flex-wrap gap-3">
                                <div class="">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="Buscar...">
                                    </div>
                                </div>
                                <div class="">
                                    <a href="./AgregarUsuario.php" class="btn btn-primary">Agregar usuario</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive ">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Cédula</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Primer apellido</th>
                                    <th scope="col">Segundo apellido</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Perfil</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>303330333</td>
                                    <td>Bryan</td>
                                    <td>Monge</td>
                                    <td>Solano</td>
                                    <td>thebryanmonge@gmail.com</td>
                                    <td>SuperAdmin</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                                            <a href="./ModificarUsuario.php" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil" style="font-size: 20px;"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm"><i class="bi bi-trash" style="font-size: 20px;"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="modalRegistro" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cita #1</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="h4 pb-2 ">Datos del solicitante</p>
                    <p class="mb-2">Cédula: <span class="fw-normal" id="cedula">303330333</span></p>
                    <p class="mb-2">Nombre: <span class="fw-normal" id="cedula">Bryan Monge Solano</span></p>
                    <p class="mb-2">Correo: <span class="fw-normal" id="cedula">thebryanmonge@gmail.com</span></p>
                    <p class="mb-2">Teléfono: <span class="fw-normal" id="cedula">8888-8888</span></p>
                    <p class="mb-2">Colegio Proveniencia: <span class="fw-normal" id="cedula">Colegio Vocacional de Artes y Oficios</span></p>
                    <hr class="my-4">
                    <p class="h4 pb-2">Datos de la cita</p>
                    <p class="mb-2">Día: <span class="fw-normal" id="cedula">Lunes 23</span></p>
                    <p class="mb-2">Hora: <span class="fw-normal" id="cedula">9:00am → 11:00am</span></p>
                    <hr class="my-4">
                    <p class="h4 pb-2">Acompañantes</p>
                    <p class="mb-2">1- <span class="fw-normal" id="cedula">202220222 Antonia García Mata</span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- IMPORT Footer  -->
    <?php
    include '../Default/Footer.html';
    ?>

    <!-- START Scripts  -->
    <?php
    include '../Default/JSImports.html';
    ?>
    <Script>
        $("#navUsuarios").addClass("active");
    </Script>
    <!-- END Scripts  -->
</body>

</html>