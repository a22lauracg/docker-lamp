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
                    <h2>Gestión de tarea</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                    if (!empty($_POST))
                    {
                        require_once('utils.php');
                        $titulo = filtraCampo($_POST['titulo']);
                        $descripcion = filtraCampo($_POST['descripcion']);
                        $estado = filtraCampo($_POST['estado']);
                        $id_usuario = filtraCampo($_POST['id_usuario']);

                        $error = false;
                        if (!validarCampoTexto($titulo))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo título es obligatorio y debe contener al menos 3 caracteres.</div>';
                        }
                        if (!validarCampoTexto($descripcion))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo descripción es obligatorio y debe contener al menos 3 caracteres.</div>';
                        }
                        if (empty($estado))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo estado es obligatorio.</div>';
                        }
                        if (!$error)
                        {
                            require_once('database.php');
                            if(nuevaTarea($titulo, $descripcion, $estado, $id_usuario))
                            { 
                                echo '<div class="alert alert-success" role="alert">Tarea guardado correctamente.</div>';
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">Ocurrió un error guardando la tarea. </div>';
                            }
                        }
                        else
                        {
                            echo '<div class="alert alert-warning" role="alert">No se pudo procesar el contenido del formulario.</div>';
                        }
                    }

                    ?>

                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
