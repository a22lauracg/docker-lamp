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
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Tarea</h2>
                </div>

                <div class="container justify-content-between">

                <?php
                    require_once('../modelo/pdo.php');
                    $id= $_GET['id'] ?? null;

                    if ($id) {
                        $con = conectaPDO();
                        $stmt = $con->prepare("SELECT t.titulo, t.descripcion, t.estado, u.username AS nombre_usuario
                            FROM tareas t 
                            JOIN usuarios u ON t.id_usuario = u.id
                            WHERE t.id = :id");
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                        $stmt->execute();
                        $tarea = $stmt->fetch(PDO::FETCH_ASSOC);

                    if (!$tarea) {
                    echo "No se encontró la tarea.";
                    exit;
                }
            } else {
                echo "No se ha seleccionado una tarea.";
                exit;
            }
            ?>
                <div class="container justify-content-between">

                    <div class="table">
                        <table class="table table-sm table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            <tbody>

                            <tr>                            
                                <th>Título:</th>
                                <td><?php echo htmlspecialchars($tarea['titulo']); ?></td>
                            </tr>
                            <tr>                            
                                <th>Descripción:</th>
                                <td><?php echo htmlspecialchars($tarea['descripcion']); ?></td>
                            </tr>
                            <tr>                            
                                <th>Estado:</th>
                                <td><?php echo htmlspecialchars($tarea['estado']); ?></td>
                            </tr>
                            <tr>                            
                                <th>Usuario:</th>
                                <td><?php echo htmlspecialchars($tarea['nombre_usuario']); ?></td>
                            </tr>
                            </tbody>
                        </table>
                </div>

                <div class="card">
                <div class="card-header">
                    Archivos adjuntos
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-block">
                        <li class="nav-item">
                            <a class="nav-link" href="/UD4/entregaTarea/tareas/subidaFichForm.php">
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary" type="button">Añadir nuevo archivo</button>
 
                    </div>
                </a>
            </li>
                    </div>
                </div>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('../vista/footer.php'); ?>

</body>
</html>
