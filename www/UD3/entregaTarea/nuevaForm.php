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
                    <h2>Nueva tarea</h2>
                </div>

                <div class="container justify-content-between">
                    <form action="nueva.php" method="POST" class="mb-5 w-50">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo isset($titulo) ? htmlspecialchars($titulo) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo isset($descripcion) ? htmlspecialchars($descripcion) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="" selected disabled>Seleccione el estado</option>
                                <option value="en_proceso" <?php echo isset($estado) && $estado == 'en_proceso' ? 'selected' : ''; ?>>En Proceso</option>
                                <option value="pendiente" <?php echo isset($estado) && $estado == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                <option value="completada" <?php echo isset($estado) && $estado == 'completada' ? 'selected' : ''; ?>>Completada</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <select class="form-select" id="id_usuario" name="id_usuario" required>
                                <option value="" selected disabled>Seleccione el usuario</option>
                                <?php
                                require_once('database.php');
                                $resultado = listaUsuarios();
                                if ($resultado && $resultado[0])
                                {
                                    $usuarios = $resultado[1];
                                    if(!empty($usuarios)){
                                        foreach ($usuarios as $usuario) {
                                            echo '<option value ="' . htmlspecialchars($usuario['id']) .'" ' . (isset($id_usuario) && $id_usuario == $usuario['id'] ? 'selected' : '') . '>' . htmlspecialchars($usuario['username']) . '</option>';
                                        }
                                        }else {
                                        echo '<option disabled>No hay usuarios disponibles</option>';
                                        }
                                }?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
