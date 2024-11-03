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
     <div class="container-fluid">
        <div class="row">
            <!-- menu -->
            <?php include 'menu.php';
            ?>
             <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center
                pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nueva tarea</h2>
                </div>
                <div class="container">
                    <form action="nueva.php" method="post" class="mb-5">
                        <div class="mb-3">
                            <label class="form-label">Identificador</label>
                            <input class="form-control" name="identificador" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción de la tarea</label>
                            <input class="form-control" name="descripcion" required>
                        </div>
                    <p>Seleciona el estado de la tarea</p>
                    <select class="form-select" name="estado" required>
                        <option value="" disabled selected>Estado de la tarea</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="enProceso">En proceso</option>
                        <option value="completada">Completada</option>
                    </select><br>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </main>
        </div>
    </div>
    <!-- footer -->
     <?php include 'footer.php';
     ?>
</body>
</html>