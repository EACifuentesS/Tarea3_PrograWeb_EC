<?php
include('components/header.php');
include('components/navbar.php');
include('backend/database.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Estudiante y Maestro a Curso</title>
</head>
<body>
    <h2>Asignar Estudiante y Maestro a Curso</h2>
    <form action="asignar.php" method="POST">
        <div class="form-group">
            <label for="curso">Curso:</label>
            <select name="curso_id" required>
                <?php
                // Obtener todos los cursos
                $query = "SELECT * FROM curso";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['codigo'] . "'>" . $row['nombre'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="estudiante">Estudiante:</label>
            <select name="estudiante_id">
                <option value="">Ninguno</option>
                <?php
                $query = "SELECT * FROM estudiante";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['numero_carnet'] . "'>" . $row['nombre'] . " " . $row['apellido'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="maestro">Maestro:</label>
            <select name="maestro_id">
                <option value="">Ninguno</option>
                <?php
                $query = "SELECT * FROM maestro";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['numero_carnet'] . "'>" . $row['nombre_completo'] . "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Asignar</button>
    </form>
</body>
</html>
