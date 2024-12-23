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
                    <h2>Gestión de usuarios</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                    if (!empty($_POST))
                    {
                        require_once('utils.php');
                        $nombre = filtraCampo($_POST['nombre']);
                        $apellidos = filtraCampo($_POST['apellidos']);
                        $username = filtraCampo($_POST['username']);
                        $contraseña = filtraCampo($_POST['contraseña']);

                    $error = false;
                    //validar nombre
                        if (!validarCampoTexto($nombre))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo nombre es obligatorio y debe contener al menos 3 caracteres.</div>';
                        }
                    //validar apellidos
                        if (!validarCampoTexto($apellidos))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo apellidos es obligatorio y debe contener al menos 3 caracteres.</div>';
                        }
                        if (!validarCampoTexto($username))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo username es obligatorio y debe contener al menos 3 caracteres.</div>';
                        }
                        if (!esNumeroValido($contraseña))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo contraseña es obligatorio y debe contener al menos 3 caracteres.</div>';
                        }
                        if (!$error)
                        {
                            require_once('database.php');
                            if(nuevoUsuario($nombre,$apellidos, $username, $contraseña))
                            { 
                                echo '<div class="alert alert-success" role="alert">Usuario guardado correctamente.</div>';
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">Ocurrió un error guardando el usuario. </div>';
                            }
                        }
                        else
                        {
                            echo '<div class="alert alert-warning" role="alert">No se pudo procesar el contenido del formulario.</div>';
                        }
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
