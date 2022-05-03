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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Recuperar Contraseña</title>
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
                        <h1 class="text-center pb-3">Recuperar Contraseña</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="../../BL/LogIn/NuevaContrasena.php" method="post">
                            <div class="mb-3">
                                <label for="newPassword1" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="newPassword1" name="newPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="newPassword2" class="form-label">Repetir Contraseña</label>
                                <input type="password" class="form-control" id="newPassword2" name="newPassword2">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Cambiar Contraseña</button>
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

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>