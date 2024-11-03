<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UD2. Tarea</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- header -->
     <?php include 'header.php';
     ?>
     <div clas="container-fluid">
        <div class="row">
            <!-- menu -->
            <?php include 'menu.php';
            ?>
             <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center
                pt-3 pb-2 mb-3 border-bottom">
                    <h2>Gestión de tareas</h2>
                </div>
                <div class="container">
                    <?php
                    include 'utils.php';

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $identificador = $_POST['identificador'];
                        $descripcion = $_POST['descripcion'];
                        $estado = $_POST['estado'];

                    //validar campos
                    $identificadorValido = numeroValido($identificador);
                    $descripcionValida = textoValido($descripcion);

                    //verificar que los campos son válidos e imprime los mensajes
                    if($identificadorValido && $descripcionValida) {
                        echo "<p class='text-success'> La tarea $identificador se ha guardado correctamente.</p>";
                        }else {
                            echo "<p class='text-danger'>Error: Revisa los campos introducidos.</p>";
                            }
                        }
                    ?>
                </div>
            </main>
        </div>
    </div>
    <!-- footer -->
     <?php include 'footer.php';
     ?>
</body>
</html>