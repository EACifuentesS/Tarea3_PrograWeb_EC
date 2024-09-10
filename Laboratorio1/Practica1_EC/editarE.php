<?php
include('backend/database.php');
include('components/header.php');
include('components/navbar.php');

if (isset($_GET['id'])) {
    $numero_carnet = $_GET['id'];
    $query = "SELECT * FROM estudiante WHERE numero_carnet = '$numero_carnet'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("No se encontró el estudiante con el carnet especificado.");
    }
} else {
    die("No se proporcionó un número de carnet.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fechanac = $_POST['fechanac'];

    $updateQuery = "UPDATE estudiante SET nombre = '$nombre', apellido = '$apellido', fecha_nacimiento = '$fechanac' WHERE numero_carnet = '$numero_carnet'";
    
    if (mysqli_query($conn, $updateQuery)) {
        echo "Estudiante actualizado exitosamente.";
    } else {
        echo "Error al actualizar estudiante: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Estudiante</title>
</head>
<body>
    <h2>Editar Estudiante</h2>
    <form action="editarE.php?id=<?php echo $numero_carnet; ?>" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" value="<?php echo htmlspecialchars($row['apellido']); ?>" required>
        </div>
        <div class="form-group">
            <label for="fechanac">Fecha de Nacimiento:</label>
            <input type="date" name="fechanac" value="<?php echo htmlspecialchars($row['fecha_nacimiento']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</body>
</html>
