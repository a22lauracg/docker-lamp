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
                    <h2>Lista de tareas</h2>
                </div>

                <div class="container justify-content-between">
                <?php require_once('utils.php'); ?>
                    <div class="table">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Id</th>                        
                                    <th>Titulo</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once('database.php');
                                    $resultado = listaTareas();
                                    if ($resultado && $resultado[0])
                                    {
                                        $tareas = $resultado[1];
                                        if ($tareas)
                                        {
                                            foreach($tareas as $tarea)
                                            {
                                                echo '<tr>';
                                                echo '<td>' . $tarea['id'] . '</td>';
                                                echo '<td>' . $tarea['titulo'] . '</td>';
                                                echo '<td>' . $tarea['descripcion'] . '</td>';
                                                echo '<td>' . $tarea['estado'] . '</td>';
                                                echo '<td>' . ($tarea['username'] ?? 'Sin usuario') . '</td>';
                                                echo '<td>';
                                                echo '<a class="btn btn-outline-success btn-sm me-1" href="editarTarea.php?id=' . $tarea['id'] . '" role="button">Editar</a></span>';
                                                echo '<a class="btn btn-outline-danger btn-sm" href="borrarTarea.php?id=' . $tarea['id'] . '" role="button">Borrar</a>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                        else{
                                            echo '<tr><td colspan="100">No hay tareas registradas</td></tr>';
                                        }
                                    }
                                    else
                                    {
                                        echo '<tr><td colspan="100">Error recuperando tareas: ' . $resultado['1'] . '</td></tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>