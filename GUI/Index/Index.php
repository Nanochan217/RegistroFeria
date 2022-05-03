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

    <title>Feria Vocacional 2022</title>
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

<div class="container-sm py-5">
    <div class="row " >
        <div class="col-4-md mx-auto bg-white rounded border p-5">
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-column align-items-center">

                        <h1 class="text-center">Feria vocacional 2022</h1>
                        <div class="text-center small alert alert-warning mt-2 mb-3 py-1" role="alert">
                            Fecha maxima de registro: <span class="fw-bold" id="fechaMaxima">Lunes 1 de Noviembre</span>
                        </div>
                        <p style="text-align: center" class="pb-2 ">
                            La tradicional feria vocacional del Colegio Vocacional de Artes y Oficios volverá a abrirse al publico. Todos los estudiantes que estén interesados en
                            asistir deben reservar una cita.
                        </p>
                        <a href="../Formulario/Formulario.php" class="btn btn-lg btn-primary" >Reservar una Cita</a>

                        <h4 class="text-center pb-3 pt-5">¿Ya tiene una cita?</h4>
                        <div class="d-flex gap-4">
                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal" data-bs-whatever="Editar Cita">Editar Cita</button>
                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal" data-bs-whatever="Cancelar Cita">Cancelar Cita</button>
                        </div>
                        <span class="pt-3">Si no recuerdas los datos de su cita,
                            <button type="button" class="link-primary bg-transparent p-0" style="border: none" data-bs-toggle="modal" data-bs-target="#modal" data-bs-whatever="Consultar Cita">
                                haz click aquí
                            </button>
                        </span>
                    </div>
            </div>

        </div>
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
                    <label for="correoRecovery" class="form-label pb-3" >Ingrese su correo electrónico y le enviaremos un enlace con los pasos a realizar.
                    </label>
                    <input type="email" class="form-control" id="correoRecovery" name="correoRecovery" placeholder="Ingrese su correo electrónico">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="Index.js"></script>
</body>
</html>