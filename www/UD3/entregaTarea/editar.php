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
                    <h2>Actualizar tarea</h2>
                </div>

                <div class="container justify-content-between">
                <form action="editar.php" method="POST" class="mb-2 w-50">
                        <?php
                        require_once('database.php');
                        if (!empty($_POST))
                        {
                            $id = $_POST['id'];
                            $titulo = $_POST['titulo'];
                            $descripcion = $_POST['descripcion'];
                            $estado = $_POST['estado'];
                            require_once('utils.php');
                            $error = false;
                            //verificar titulo
                            if (!validarCampoTexto($titulo))
                            {
                                $error = true;
                                echo '<div class="alert alert-danger" role="alert">El campo titulo es obligatorio y debe contener al menos 3 caracteres.</div>';
                            }
                            //verificar descripción
                            if (!validarCampoTexto($descripcion))
                            {
                                $error = true;
                                echo '<div class="alert alert-danger" role="alert">El campo descripción es obligatorio y debe contener al menos 3 caracteres.</div>';
                            }
                            if (!$error)
                            {
                                require_once('database.php');
                                $resultado = actualizaTarea($id, filtraCampo($titulo), filtraCampo($descripcion), filtraCampo($estado));
                                if ($resultado[0])
                                {
                                    echo '<div class="alert alert-success" role="alert">Usuario actualizado correctamente.</div>';
                                }
                                else
                                {
                                    echo '<div class="alert alert-danger" role="alert">Ocurrió un error actualizando el usuario: ' . $resultado[1] . '</div>';
                                }
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">No se pudo recuperar la información del usuario.</div>';
                            }
                        }
                        else
                        {
                            echo '<div class="alert alert-danger" role="alert">Debes acceder a través del formulario de edición de usuarios.</div>';
                        }
                        ?>
                        
                    </form>
                </div>

                <div class="container justify-content-between mb-2">
                    <a class="btn btn-info btn-sm" href="tareas.php" role="button">Volver</a>
                </div>

            </main>
        </div>
    </div>


    <?php include_once('footer.php'); ?>
    
</body>
</html>