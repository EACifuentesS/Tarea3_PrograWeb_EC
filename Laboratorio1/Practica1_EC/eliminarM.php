<?php
include('backend/database.php');
include('components/header.php');
include('components/navbar.php');

if (isset($_GET['id'])) {
    $numero_carnet = $_GET['id'];
    $query = "SELECT * FROM maestro WHERE numero_carnet = '$numero_carnet'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("No se encontró el maestro con el carnet especificado.");
    }
} else {
    die("No se proporcionó un número de carnet.");
}

if (isset($_GET['id'])) {
    $numero_carnet = $_GET['id'];
    $query = "DELETE FROM maestro WHERE numero_carnet = '$numero_carnet'";

    if (mysqli_query($conn, $query)) {
        echo "Estudiante eliminado exitosamente.";
    } else {
        echo "Error al eliminar estudiante: " . mysqli_error($conn);
    }
} else {
    die("No se proporcionó un número de carnet.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Maestro</title>
</head>
<body>
    <h2>Editar Maestro</h2>
    <form action="editarM.php?id=<?php echo $numero_carnet; ?>" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre_completo" value="<?php echo htmlspecialchars($row['nombre_completo']); ?>" required>
        </div>
        <div class="form-group">
            <label for="fechanac">Fecha de Nacimiento:</label>
            <input type="date" name="fechanac" value="<?php echo htmlspecialchars($row['fecha_nacimiento']); ?>" required>
        </div>
    </form>
</body>
</html>