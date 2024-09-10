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
    <title>Ver Notas</title>
</head>
<body>
    <h2>Ver Notas</h2>
    <form method="GET" action="ver_notas.php">
        <label for="maestro_id">Selecciona un Maestro:</label>
        <select name="maestro_id" id="maestro_id" required>
            <option value="">Seleccione un maestro</option>
            <?php
            while ($row = mysqli_fetch_assoc($resultMaestros)) {
                echo "<option value='" . $row['numero_carnet'] . "'>" . $row['nombre_completo'] . "</option>";
            }
            ?>
        </select>
        <button type="submit">Ver Notas</button>
    </form>

    <?php
    if (isset($_GET['maestro_id'])) {
        $maestro_id = $_GET['maestro_id'];

        $queryNotas = "SELECT e.numero_carnet, e.nombre, e.apellido, n.zona, n.examen, (n.zona + n.examen) AS total
                       FROM estudiante e 
                       INNER JOIN notas n ON e.numero_carnet = n.estudiante_id 
                       WHERE n.curso_id IN (SELECT c.codigo FROM curso c WHERE c.maestro_id = '$maestro_id')";

        $resultNotas = mysqli_query($conn, $queryNotas);
        if (!$resultNotas) {
            die("Error en la consulta SQL: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($resultNotas) > 0) {
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Carnet</th>
                    <th>Nombre</th>
                    <th>Zona (60 puntos)</th>
                    <th>Examen (30 puntos)</th>
                    <th>Total (100 puntos)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($nota = mysqli_fetch_assoc($resultNotas)) {
                    echo "<tr>
                            <td>" . $nota['numero_carnet'] . "</td>
                            <td>" . $nota['nombre'] . " " . $nota['apellido'] . "</td>
                            <td>" . $nota['zona'] . "</td>
                            <td>" . $nota['examen'] . "</td>
                            <td>" . $nota['total'] . "</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    <?php
        } else {
            echo "<p>No hay notas registradas para los alumnos asignados a este maestro.</p>";
        }
    }
    ?>
</body>
</html>
