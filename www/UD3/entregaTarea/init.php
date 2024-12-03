<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD3. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Iniciar aplicación</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                        require_once('database.php');
                        if (creaDB())
                        {
                            echo '<div class="alert alert-success" role="alert">Base de datos Tareas creada correctamente.</div>';
                        }
                        else
                        {
                            echo '<div class="alert alert-warning" role="alert">Error al crear la base de datos.</div>';
                        }
                        if (creaTablaUsuarios())
                        {
                            echo '<div class="alert alert-success" role="alert">Tabla usuarios creada correctamente.</div>';
                        }
                        else
                        {
                            echo '<div class="alert alert-warning" role="alert">Error creando tabla usuarios.</div>';
                        }
                        if (creaTablaTareas())
                        {
                            echo '<div class="alert alert-success" role="alert">Tabla tareas creada correctamente.</div>';
                        }
                        else
                        {
                            echo '<div class="alert alert-warning" role="alert">Error creando tabla tareas.</div>';
                        }
                    ?>
                </div>
                <?php include_once('volver.php'); ?>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>