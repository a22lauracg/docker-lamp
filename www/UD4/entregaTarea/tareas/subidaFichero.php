<?php
require_once('../modelo/pdo.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo"])) {
    $nombreArchivo = $_POST["nombre"] ?? null;
    $descripcion = $_POST["descripcion"]?? null;
    $archivo = $_FILES["archivo"] ?? null;

    $nombreOriginal = basename($archivo["name"]);
    $rutaDestino = "uploads/" . $nombreOriginal;
    $tipoArchivo = $archivo["type"];
    $tamanoArchivo = $archivo["size"];
    
    if ($tamanoArchivo > 20 * 1024 * 1024) { 
        die("Error: El archivo es demasiado grande.");
    }
    
    if (move_uploaded_file($archivo["tmp_name"], $rutaDestino)) {
        try {
            $con = conectaPDO();
            $stmt = $con->prepare("INSERT INTO ficheros (nombre, file, descripcion) VALUES (:nombre, :file, :descripcion)");
            $stmt->bindParam(":nombre", $nombreArchivo);
            
            $stmt->bindParam(":ruta", $rutaDestino);
            $stmt->bindParam(":descripcion", $descripcion);
            $stmt->bindParam(":tamano", $tamanoArchivo);
            $stmt->execute();

            echo "Archivo subido y guardado correctamente.";
        } catch (PDOException $e) {
            echo "Error al guardar en la BD: " . $e->getMessage();
        }
    } else {
        echo "Error al subir el archivo.";
    }
} else {
    echo "No se ha enviado ningún archivo.";
}
?>
