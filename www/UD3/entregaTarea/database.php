<?php

function conecta($host, $user, $pass, $db)
{
    $conexion = new mysqli($host, $user, $pass, $db);
    return $conexion;
}

function conectaTareas()
{
    return conecta('db', 'root', 'test', 'tareas');
}

function cerrarConexion($conexion)
{
    if (isset($conexion) && $conexion->connect_errno === 0) {
        $conexion->close();
    }
}

function creaDB()
{
    try {
        $conexion = conecta('db', 'root', 'test', null);
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            // Verificar si la base de datos ya existe
            $sqlCheck = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'tareas'";
            $resultado = $conexion->query($sqlCheck);
            if ($resultado && $resultado->num_rows > 0) {
                return [false, 'La base de datos "tareas" ya existía.'];
            }

            $sql = 'CREATE DATABASE IF NOT EXISTS tareas';
            if ($conexion->query($sql))
            {
                return [true, 'Base de datos "tareas" creada correctamente'];
            }
            else
            {
                return [false, 'No se pudo crear la base de datos "tareas".'];
            }
        }
    }
    catch (mysqli_sql_exception $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function creaTablaUsuarios()
{
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            // Verificar si la tabla ya existe
            $sqlCheck = "SHOW TABLES LIKE 'usuarios'";
            $resultado = $conexion->query($sqlCheck);

            if ($resultado && $resultado->num_rows > 0)
            {
                return [false, 'La tabla "usuarios" ya existía.'];
            }

        $sql = '
            CREATE TABLE IF NOT EXISTS `tareas`.`usuarios`(
                `id` INT NOT NULL AUTO_INCREMENT,
                `nombre` VARCHAR(50) NOT NULL,
                `apellidos` VARCHAR(100) NOT NULL,
                `username` VARCHAR(50) NOT NULL,
                `contraseña` VARCHAR(100) NOT NULL,
                PRIMARY KEY (`id`)
            )';
            if ($conexion->query($sql))
            {
                return [true, 'Tabla "usuarios" creada correctamente'];
            }
            else
            {
                return [false, 'No se pudo crear la tabla "usuarios".'];
            }
        }
    }
    catch (mysqli_sql_exception $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function creaTablaTareas()
{
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            // Verificar si la tabla ya existe
            $sqlCheck = "SHOW TABLES LIKE 'tareas'";
            $resultado = $conexion->query($sqlCheck);

            if ($resultado && $resultado->num_rows > 0)
            {
                return [false, 'La tabla "tareas" ya existía.'];
            }

        $sql = '
            CREATE TABLE IF NOT EXISTS `tareas`.`tareas`(
                `id` INT NOT NULL AUTO_INCREMENT,
                `titulo` VARCHAR(50) NOT NULL,
                `descripcion` VARCHAR(50) NOT NULL,
                `estado` VARCHAR(50) NOT NULL,
                `id_usuario` INT(100) NOT NULL,
                PRIMARY KEY (`id`),
                FOREIGN KEY (`id_usuario`) REFERENCES usuarios(`id`) ON DELETE CASCADE      
            )';
            if ($conexion->query($sql))
            {
                return [true, 'Tabla "tareas" creada correctamente'];
            }
            else
            {
                return [false, 'No se pudo crear la tabla "tareas".'];
            }
        }
    }
    catch (mysqli_sql_exception $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function nuevoUsuario($nombre, $apellidos, $username, $contraseña)
{
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, username, contraseña) VALUES (?, ?, ?, ?)");
            $stmt->bind_Param("sssi", $nombre, $apellidos, $username, $contraseña);
        
            $stmt->execute();

            return [true, 'Usuario creado correctamente'];
        }

        
    }
    catch (mysqli_sql_exception $e) 
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}  

function listaUsuarios() {
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "SELECT * FROM usuarios";
            $resultados = $conexion->query($sql);
            return [true, $resultados->fetch_all(MYSQLI_ASSOC)];
        }
        
    }
    catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function nuevaTarea($titulo, $descripcion, $estado, $id_usuario)
{
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $stmt = $conexion->prepare("INSERT INTO tareas (titulo, descripcion, estado, id_usuario)
                VALUES (?, ?, ?, ?)");
            $stmt->bind_Param("ssss", $titulo, $descripcion, $estado, $id_usuario);
        
            $stmt->execute();

            return [true, 'Tarea creada correctamente'];
        }

        
    }
    catch (mysqli_sql_exception $e) 
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}  

function listaTareas() {
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "SELECT t.id, t.titulo, t.descripcion, t.estado, u.username
                FROM tareas t
                LEFT JOIN usuarios u ON t.id_usuario = u.id";
            $resultados = $conexion->query($sql);

            if ($resultados->num_rows >0) {
              return [true, $resultados->fetch_all(MYSQLI_ASSOC)];  
            }else {
                return [true, []];
            }
        }
        }catch (mysqli_sql_exception $e) {
            return [false, $e->getMessage()];
        }finally{

        cerrarConexion($conexion);
        }
    }

function buscarTarea($id)
{
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "SELECT * FROM tareas WHERE id = " . $id;
            $resultados = $conexion->query($sql);
            if ($resultados->num_rows == 1)
            {
                return [true, $resultados->fetch_assoc()];
            }
            else
            {
                return [false, 'No se pudo recuperar la tarea.'];
            }
        }
    }
    catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function actualizaTarea($id, $titulo, $descripcion, $estado)
{
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "UPDATE tareas SET titulo = ?, descripcion = ?, estado = ? WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            
            $stmt->bind_param("sssi", $titulo, $descripcion, $estado, $id);

            $stmt->execute();

            return [true, 'Tarea actualizada correctamente.'];
            
        }
        
    }
    catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}
function borraTarea($id)
{
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "DELETE FROM tareas WHERE id = " . $id;
            if ($conexion->query($sql))
            {
                return [true, 'Tarea borrada correctamente.'];
            }
            else
            {
                return [false, 'No se pudo borrar la tarea.'];
            }
            
        }
        
    }
    catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function buscarUsuario($id)
{
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "SELECT * FROM usuarios WHERE id = " . $id;
            $resultados = $conexion->query($sql);
            if ($resultados->num_rows == 1)
            {
                return [true, $resultados->fetch_assoc()];
            }
            else
            {
                return [false, 'No se pudo recuperar el usuario.'];
            }
            
        }
        
    }
    catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function actualizaUsuario($id, $nombre, $apellidos, $username, $contraseña)
{
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "UPDATE usuarios SET nombre = ?, apellidos = ?, username = ?, contraseña = ? WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            
            $stmt->bind_param("sssii", $nombre, $apellidos, $username, $contraseña, $id);

            $stmt->execute();

            return [true, 'Usuario actualizado correctamente.'];
            
        }
        
    }
    catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function borraUsuario($id)
{
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "DELETE FROM usuarios WHERE id = " . $id;
            if ($conexion->query($sql))
            {
                return [true, 'Usuario borrado correctamente.'];
            }
            else
            {
                return [false, 'No se pudo borrar el usuario.'];
            }
            
        }
        
    }
    catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function buscarTareasUsuario ($id_usuario, $estado = null) {

        $conexion = conectaTareas();

            $sql = "SELECT t.*, u.username
                FROM tareas t
                JOIN usuarios u ON t.id_usuario = u.id
                WHERE t.id_usuario = ?";
        
            if (!empty($estado)) {
            $sql .= " AND estado = ?";

            }
            $stmt = $conexion->prepare($sql);

            if (!empty($estado)) {

            $stmt->bind_param("is", $id_usuario, $estado);
            }
            else{
            $stmt->bind_param("i", $id_usuario);
            }
            $stmt->execute();
    
            $resultado = $stmt->get_result();
            
            if($resultado->num_rows > 0) {
            $tareas = [];
            while ($tarea = $resultado->fetch_assoc()) {
            $tareas[] = $tarea;
        }
        
        return [true, $tareas];
    }
    else {
    return [false, null];
    }
    }
    