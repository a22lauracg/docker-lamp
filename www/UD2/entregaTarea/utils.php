<?php
//se crea un array con una lista de tareas
$tareas = [
    [
        'id' => 1,
        'descripcion' => 'Leer los apuntes',
        'estado' => 'Completada'
    ],

    [
        'id' => 2,
        'descripcion' => 'Ver tutorías',
        'estado' => 'Completada'
    ],

    [
        'id' => 3,
        'descripcion' => 'Hacer la tarea',
        'estado' => 'En proceso'
    ],
    [
        'id' => 4,
        'descripcion' => 'Subir la tarea a git',
        'estado' => 'Pendiente'
    ]
    ];

    //función para imprimir la lista de tareas
    function imprimirTareas($tareas) {
        echo "<table class = 'table table-sriped table-hover'>";
        echo "<thead>
                <tr>
                    <th>Identificador</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                </tr>
                </thead>";

        echo "</tbody>";

        foreach ($tareas as $tarea) {
            echo "<tr>";
            echo "<td>{$tarea['id']}</td>";
            echo "<td>{$tarea['descripcion']}</td>";
            echo "<td>{$tarea['estado']}</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }

    function filtrarContenido($campo) {
        //elimina caracteres especiales
        $campo = preg_replace("/[^a-zA-Z0-9\s]/", "", $campo);

        //elimina espacios duplicados
        $campo = preg_replace("/s+/", " ", $campo);

        //elimina espacios al inicio y al final
        $campo = trim($campo);

        return $campo;
    }
    //verificar el texto introducido
    function textoValido($campo, $minLongitud = 1, $maxLongitud = 255){// texto de 1 a 255 caracteres
        $campo = filtrarContenido($campo);

        if (empty($campo)) { //que el texto no estea vacío
            return false;
        }
        $longitud = strlen($campo);
        if ($longitud < $minLongitud || $longitud > $maxLongitud) { //texto entre 1 y 255 caracteres
            return false;
        }
        return true;
    }
    //comprobar que en identificador se introduzca un número
    function numeroValido($campo) {
        $campo = filtrarContenido($campo);

        return is_numeric($campo) && !empty($campo);
    }
?>