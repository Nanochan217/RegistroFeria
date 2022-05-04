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

    <title>Agregar Usuario</title>
    <!-- START CSS  -->
    <style>
        <?php
        include '../Default/Style.css';
        ?>@media (max-width: 768px) {
            #textoEliminar {
                display: inline !important;
                margin-top: 10px;
            }
        }
    </style>
    <!-- END CSS  -->
</head>

<body class="bg-light">

    <?php
    include '../Default/HeaderLogged.html';
    ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- Titulo de la pagina -->
                <div class="pt-5 pb-4">
                    <h1 class="text-center">Agregar Usuario</h1>
                </div>

                <!-- Formulario START-->
                <form action="../../BL/Usuario/NuevoUsuario.php" method="POST" class="row gap-3">

                    <!-- START Sección de datos del solicitante -->
                    <div class="row border rounded bg-white shadow-sm p-5">
                        <h2 class="pb-4">Datos del usuario</h2>

                        <!-- Imputs 1 -->
                        <div class="row">

                            <!-- Cedula -->
                            <div class="col-md-3 pb-3">
                                <label for="cedula" class="form-label">Cedula</label>
                                <input type="text" class="form-control " id="cedula" name="cedula" required>
                            </div>

                            <!-- Nombre -->
                            <div class="col-md-3 pb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control " id="nombre" name="nombre" required>
                            </div>

                            <!-- Apellido 1 -->
                            <div class="col-md-3 pb-3">
                                <label for="apellido1" class="form-label">Primer apellido</label>
                                <input type="text" class="form-control " id="apellido1" name="apellido1" required>
                            </div>

                            <!-- Apellido 2 -->
                            <div class="col-md-3 pb-3">
                                <label for="apellido2" class="form-label">Segundo apellido</label>
                                <input type="text" class="form-control " id="apellido2" name="apellido2" required>
                            </div>
                        </div>

                        <!-- Imputs 2 -->
                        <div class="row">

                            <!-- Correo -->
                            <div class="col-md-4 pb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="text" class="form-control " id="email" name="email" required>
                            </div>

                            <!-- Contrasena -->
                            <div class="col-md-4 pb-3">
                                <label for="contrasena" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                            </div>

                            <!-- Tipo perfil -->
                            <div class="col-md-4 pb-3">
                                <label for="tipoPerfil" class="form-label">Tipo perfil</label>
                                <select id="tipoPerfil" name="tipoPerfil" class="form-select" required>
                                    <option selected>Seleccione un perfil</option>
                                    <option value="1">SuperAdmin</option>
                                    <option value="2">Admin</option>
                                    <option value="3">Guarda</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- END Sección de datos del solicitante -->

                    <div class="row gap-3 p-0">
                        <div class="col position-relative px-0 py-5">
                            <div class="d-flex gap-3 position-absolute top-0 end-0">
                                <a href="./Usuarios.php" class="btn btn-danger">Descartar</a>
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </div>
                    </div>

                </form>
                <!-- Formulario END -->

            </div>
        </div>
    </div>

    <!--  Footer  -->
    <?php
    include '../Default/Footer.html';
    ?>

    <!-- START Scripts  -->
    <?php
    include '../Default/JSImports.html';
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <Script>
        $("#navUsuarios").addClass("active");
    </Script>
    <!-- END Scripts  -->
</body>

</html>