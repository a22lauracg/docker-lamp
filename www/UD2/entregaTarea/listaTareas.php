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
                    <h2>Mis tareas</h2>
                </div>
                <div class="container">
                <div class="table">
                    <?php
                    include 'utils.php';
                        //llamar a la función para imprimir las tareas
                        imprimirTareas($tareas);
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
