<?php

function conectaPDO()
{
    $servername = $_ENV ['DATABASE_HOST'];
    $username = $_ENV ['DATABASE_USER'];
    $password = $_ENV ['DATABASE_PASSWORD'];
    $dbname = $_ENV ['DATABASE_NAME'];

    $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conPDO;
}

function listaUsuarios()
{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT id, rol, username, nombre, apellidos FROM usuarios');
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultados = $stmt->fetchAll();
        return [true, $resultados];
    }
    catch (PDOException $e) {
        return [false, $e->getMessage()];
    }
    finally {
        $con = null;
    }
    
}

function listaTareasPDO($id_usuario, $estado)
{
    try {
        $con = conectaPDO();
        $sql = 'SELECT * FROM tareas WHERE id_usuario = ' . $id_usuario;
        if (isset($estado))
        {
            $sql = $sql . " AND estado = '" . $estado . "'";
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $tareas = array();
        while ($row = $stmt->fetch())
        {
            $usuario = buscaUsuario($row['id_usuario']);
            $row['id_usuario'] = $usuario['username'];
            array_push($tareas, $row);
        }
        return [true, $tareas];
    }
    catch (PDOException $e) {
        return [false, $e->getMessage()];
    }
    finally {
        $con = null;
    }
    
}

function nuevoUsuario($nombre, $apellidos, $rol, $username, $contrasena)
{
    try{
        $con = conectaPDO();
        $stmt = $con->prepare("INSERT INTO usuarios (nombre, apellidos, rol, username, contrasena) VALUES (:nombre, :apellidos, :rol, :username, :contrasena)");
        
        //$rol = empty($rol) ? 0 : $rol;
        
        
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->execute();
        
        $stmt->closeCursor();

        return [true, null];
    }
    catch (PDOException $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        $con = null;
    }
}

function actualizaUsuario($id, $rol, $nombre, $apellidos, $username, $contrasena)
{
    try{
        $con = conectaPDO();
        $sql = "UPDATE usuarios SET rol = :rol, nombre = :nombre, apellidos = :apellidos, username = :username";

        if (isset($contrasena))
        {
            $sql = $sql . ', contrasena = :contrasena';
        }

        $sql = $sql . ' WHERE id = :id';

        $stmt = $con->prepare($sql);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':username', $username);
        if (isset($contrasena)) $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        
        $stmt->closeCursor();

        return [true, null];
    }
    catch (PDOExcetion $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        $con = null;
    }
}

function borraUsuario($id)
{
    try {
        $con = conectaPDO();

        $con->beginTransaction();

        $stmt = $con->prepare('DELETE FROM tareas WHERE id_usuario = ' . $id);
        $stmt->execute();
        $stmt = $con->prepare('DELETE FROM usuarios WHERE id = ' . $id);
        $stmt->execute();
        
        return [$con->commit(), ''];
    }
    catch (PDOExcetion $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        $con = null;
    }
}

function buscaUsuario($id)
{

    try
    {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT * FROM usuarios WHERE id = ' . $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() == 1)
        {
            return $stmt->fetch();
        }
        else
        {
            return null;
        }
    }
    catch (PDOExcetion $e)
    {
        return null;
    }
    finally
    {
        $con = null;
    }
    
}