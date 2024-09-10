<?php
include('backend/database.php');
include('components/header.php');
include('components/navbar.php');

$queryMaestros = "SELECT numero_carnet, nombre_completo FROM maestro";
$resultMaestros = mysqli_query($conn, $queryMaestros);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingreso de Notas</title>
</head>
<body>
    <h2>Ingreso de Notas</h2>
    <form method="GET" action="ingreso_notas.php">
        <label for="maestro_id">Selecciona un Maestro:</label>
        <select name="maestro_id" id="maestro_id" required>
            <option value="">Seleccione un maestro</option>
            <?php
            while ($row = mysqli_fetch_assoc($resultMaestros)) {
                echo "<option value='" . $row['numero_carnet'] . "'>" . $row['nombre_completo'] . "</option>";
            }
            ?>
        </select>
        <button type="submit">Ver Alumnos</button>
    </form>

    <?php
    if (isset($_GET['maestro_id'])) {
        $maestro_id = $_GET['maestro_id'];
        $queryAlumnos = "SELECT e.numero_carnet, e.nombre, e.apellido FROM estudiante e 
                         INNER JOIN asignacion a ON e.numero_carnet = a.estudiante_id 
                         WHERE a.curso_id IN (SELECT c.codigo FROM curso c WHERE c.maestro_id = '$maestro_id')";
        $resultAlumnos = mysqli_query($conn, $queryAlumnos);
        if (mysqli_num_rows($resultAlumnos) > 0) {
    ?>
        <form method="POST" action="ingreso_notas.php">
            <input type="hidden" name="maestro_id" value="<?php echo $maestro_id; ?>">
            <table class="table">
                <thead>
                    <tr>
                        <th>Carnet</th>
                        <th>Nombre</th>
                        <th>Zona (60 puntos)</th>
                        <th>Examen (30 puntos)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($alumno = mysqli_fetch_assoc($resultAlumnos)) {
                        echo "<tr>
                                <td>" . $alumno['numero_carnet'] . "</td>
                                <td>" . $alumno['nombre'] . " " . $alumno['apellido'] . "</td>
                                <td><input type='number' name='zona[" . $alumno['numero_carnet'] . "]' min='0' max='60' required></td>
                                <td><input type='number' name='examen[" . $alumno['numero_carnet'] . "]' min='0' max='40' required></td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Guardar Notas</button>
        </form>
    <?php
        } else {
            echo "<p>No hay alumnos asignados a este maestro.</p>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $maestro_id = $_POST['maestro_id'];
        $zona = $_POST['zona'];
        $examen = $_POST['examen'];

        foreach ($zona as $estudiante_id => $zonaNota) {
            $examenNota = $examen[$estudiante_id];
            $curso_id = "(SELECT c.codigo FROM curso c WHERE c.maestro_id = '$maestro_id')"; 
            
            $queryNotas = "INSERT INTO notas (estudiante_id, curso_id, zona, examen)
                           VALUES ('$estudiante_id', $curso_id, '$zonaNota', '$examenNota')
                           ON DUPLICATE KEY UPDATE zona = '$zonaNota', examen = '$examenNota'";
            
            if (!mysqli_query($conn, $queryNotas)) {
                echo "Error al guardar las notas: " . mysqli_error($conn);
            }
        }
        echo "<p>Notas guardadas exitosamente.</p>";
    }
    ?>
</body>
</html>
