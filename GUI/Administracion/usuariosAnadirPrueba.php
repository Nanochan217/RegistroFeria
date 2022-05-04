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

    <title>Nuevo Usuario</title>

    <!-- START CSS  -->
    <style>
        <?php
        include '../Default/Style.css';
        ?>
    </style>
    <!-- END CSS  -->
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row pb-4">
            <div class="col">
                <img class="mx-auto d-block" width="150px" src="../Assets/Images/LogoCovao.png">
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 mx-auto bg-white rounded border shadow-sm p-5">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center pb-3">Nuevo Usuario</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="../../BL/Usuario/NuevoUsuario.php" method="post">
                            <div class="mb-3">
                                <label for="cedula" class="form-label">Cedula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellido1" class="form-label">Apellido 1</label>
                                <input type="text" class="form-control" id="apellido1" name="apellido1" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellido2" class="form-label">Apellido 2</label>
                                <input type="text" class="form-control" id="apellido2" name="apellido2" required>
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="horario" class="form-label">Perfil</label>
                                <select id="perfil" name="perfil" class="form-select" required>
                                    <option selected>Seleccione un Perfil</option>
                                    <option value="1">SuperAdmin</option>
                                    <option value="2">Admin</option>
                                    <option value="3">Guarda</option>
                                </select>
                            </div>                           
                            <button type="submit" class="btn btn-primary mt-3" id="nuevoUsuario">Agregar Usuario</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Footer  -->
    <?php
    include '../Default/Footer.html';
    ?>

    <!-- Modal Password Recovery -->
    <div class="modal fade" id="modalPassRecovery" tabindex="-1" aria-labelledby="modalPassRecovery" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="../../BL/LogIn/VerificarCorreo.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPassRecoveryLabel">Recuperar Contraseña</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="correoRecovery" class="form-label pb-3">Ingrese su correo electrónico y le enviaremos un enlace para restablecer su contraseña.</label>
                            <input type="email" class="form-control" id="correoRecovery" name="correoRecovery" placeholder="Ingrese su correo electrónico" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="Submit" class="btn btn-primary">Enviar Confirmación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- START Scripts  -->
    <?php
        include '../Default/JSImports.html';        
    ?>
    <!-- END Scripts  -->
</body>

</html>