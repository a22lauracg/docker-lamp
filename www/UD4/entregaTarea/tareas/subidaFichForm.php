<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD4. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once('../vista/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('../vista/menu.php'); ?>
        
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <form action="subidaFichero.php" method="post" enctype="multipart/form-data">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Adjuntar archivo</h2>
                </div>

                <div class="mb-3">
                    <label for="nombreArchivo" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombreArchivo" name="nombre" placeholder="Introduce un nombre">
                </div>
                <div class="mb-3">
                    <label for="descripcionArchivo" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcionArchivo" rows="3">Introduce una descripción</textarea>
                </div>

            <div class="mb-3">
                <label for="archivo" class="form-label">Seleccionar un archivo</label>
                <input class="form-control" type="file" id="archivo" name="archivo" required>
            </div>

            <button type="submit" class="btn btn-primary">Subir archivo</button>
            </form>
        </div>

    </div>


    <?php include_once('../vista/footer.php'); ?>
    
</body>
</html>
