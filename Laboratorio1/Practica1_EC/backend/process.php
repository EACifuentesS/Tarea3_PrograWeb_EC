<?php
include('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $entidad = $_POST['entidad'];

    if ($action === 'createE') {
        if ($entidad === 'estudiante') {
            $carnet = $_POST['carnet'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $fechanac = $_POST['fechanac'];

            $query = "INSERT INTO estudiante (numero_carnet, nombre, apellido, fecha_nacimiento) VALUES ('$carnet', '$nombre', '$apellido', '$fechanac')";

            if (mysqli_query($conn, $query)) {
                echo ucfirst($entidad) . " creado exitosamente.";
            } else {
                echo "Error al crear " . $entidad . ": " . mysqli_error($conn);
            }
        } 
    }   
    if ($action === 'createM') {  
        if ($entidad === 'maestro') {
            $numero_carnet = $_POST['numero_carnet'];
            $nombre_completo = $_POST['nombre_completo'];
            $fecha_nac = $_POST['fecha_nac'];

            $query = "INSERT INTO maestro (numero_carnet, nombre_completo, fecha_nacimiento) VALUES ('$numero_carnet', '$nombre_completo', '$fecha_nac')";

            if (mysqli_query($conn, $query)) {
                echo ucfirst($entidad) . " creado exitosamente.";
            } else {
                echo "Error al crear " . $entidad . ": " . mysqli_error($conn);
            }
        } 
    }  

    if ($action === 'createC') { 
        if ($entidad === 'curso') {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $maestro_id = !empty($_POST['maestro_id']) ? $_POST['maestro_id'] : "NULL"; // Permitir valor nulo

            $query = "INSERT INTO curso (codigo, nombre, descripcion, maestro_id) VALUES ('$codigo', '$nombre', '$descripcion', $maestro_id)";
        }

        if (mysqli_query($conn, $query)) {
            echo ucfirst($entidad) . " creado exitosamente.";
        } else {
            echo "Error al crear " . $entidad . ": " . mysqli_error($conn);
        }
    }  
}

if ($action === 'list') {
    $query = "SELECT * FROM estudiante";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table'><tr><th>Carnet</th><th>Nombre</th><th>Apellido</th><th>Fecha de Nacimiento</th><th>Acciones</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['numero_carnet'] . "</td>
                    <td>" . $row['nombre'] . "</td>
                    <td>" . $row['apellido'] . "</td>
                    <td>" . $row['fecha_nacimiento'] . "</td>
                    <td>
                <button class='btn btn-warning' onclick='window.location.href=\"editarE.php?id=" . $row['numero_carnet'] . "\"'>Editar</button>
                <button class='btn btn-danger' onclick='window.location.href=\"eliminarE.php?id=" . $row['numero_carnet'] . "\"'>Eliminar</button>
            </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No hay estudiantes registrados.";
    }
}

if ($action === 'listM') {
    $query = "SELECT * FROM maestro";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table'><tr><th>Carnet</th><th>Nombre Completo</th><th>Fecha de Nacimiento</th><th>Acciones</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['numero_carnet'] . "</td>
                    <td>" . $row['nombre_completo'] . "</td>
                    <td>" . $row['fecha_nacimiento'] . "</td>
                     <td>
                <button class='btn btn-warning' onclick='window.location.href=\"editarM.php?id=" . $row['numero_carnet'] . "\"'>Editar</button>
                <button class='btn btn-danger' onclick='window.location.href=\"eliminarM.php?id=" . $row['numero_carnet'] . "\"'>Eliminar</button>
            </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No hay maestros registrados.";
    }
}

if ($action === 'listC') {
    $query = "SELECT * FROM curso";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table'><tr><th>Código</th><th>Nombre</th><th>Descripción</th><th>Maestro</th><th>Acciones</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['codigo'] . "</td>
                    <td>" . $row['nombre'] . "</td>
                    <td>" . $row['descripcion'] . "</td>
                    <td>" . $row['maestro_id'] . "</td>
                   <td>
                <button class='btn btn-warning' onclick='window.location.href=\"editarC.php?id=" . $row['codigo'] . "\"'>Editar</button>
                <button class='btn btn-danger' onclick='window.location.href=\"eliminarC.php?id=" . $row['codigo'] . "\"'>Eliminar</button>
            </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No hay cursos registrados.";
    }
}
?>