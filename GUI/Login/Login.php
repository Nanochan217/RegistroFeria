<?php
    //Librerias Ncesarias
?>


<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Iniciar Sesión</title>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row pb-4">
            <div class="col">
                <img class="mx-auto d-block" width="150px" src="../Assets/Images/logoCovao.png">
            </div>
        </div>
        <div class="row " >
            <div class="col-4-md mx-auto bg-white rounded border p-5">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center pb-3">Iniciar Sesión</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="../../BL/LogIn/NuevaSesion.php" method="post">
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo" name="usuario">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <div id="PassRecovery" class="form-text">
                                    <button type="button" class="link-primary bg-transparent" style="border: none" data-bs-toggle="modal" data-bs-target="#modalPassRecovery">
                                        ¿Olvidó su contraseña?
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Ingresar</button>
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
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPassRecoveryLabel">Recuperar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="correoRecovery" class="form-label pb-3" >Ingrese su correo electrónico y le enviaremos un enlace para restablecer su contraseña.
                        </label>
                        <input type="email" class="form-control" id="correoRecovery" name="correoRecovery" placeholder="Ingrese su correo electrónico">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Enviar Confirmación</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>