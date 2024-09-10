<?php
include('backend/database.php');
include('components/header.php');
include('components/navbar.php');

if (isset($_GET['id'])) {
    $codigo = $_GET['id'];
    $query = "SELECT * FROM curso WHERE codigo = '$codigo'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("No se encontró el curso con el código especificado.");
    }
} else {
    die("No se proporcionó un código de curso.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $maestro_id = $_POST['maestro_id'];
    $checkQuery = "SELECT * FROM maestro WHERE numero_carnet = '$maestro_id'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $updateQuery = "UPDATE curso SET nombre = '$nombre', descripcion = '$descripcion', maestro_id = '$maestro_id' WHERE codigo = '$codigo'";

        if (mysqli_query($conn, $updateQuery)) {
            echo "Curso actualizado exitosamente.";
        } else {
            echo "Error al actualizar el curso: " . mysqli_error($conn);
        }
    } else {
        echo "El ID del maestro proporcionado no existe. Por favor, ingrese un ID de maestro válido.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Curso</title>
</head>
<body>
    <h2>Editar Curso</h2>
    <form action="editarC.php?id=<?php echo $codigo; ?>" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" value="<?php echo htmlspecialchars($row['descripcion']); ?>" required>
        </div>
        <div class="form-group">
            <label for="maestro_id">Maestro ID:</label>
            <input type="number" name="maestro_id" value="<?php echo htmlspecialchars($row['maestro_id']); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</body>
</html>
