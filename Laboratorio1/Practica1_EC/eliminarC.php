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

if (isset($_GET['id'])) {
    $codigo = $_GET['id'];

    $query = "DELETE FROM curso WHERE codigo = '$codigo'";

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
    <title>Curso Eliminado</title>
</head>
<body>
    <h2>Curso Eliminado</h2>
    <form action="editarM.php?id=<?php echo $numero_carnet; ?>" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="codigo" value="<?php echo htmlspecialchars($row['codigo']); ?>" required>
        </div>
        <div class="form-group">
            <label for="nombre">Descripcion:</label>
            <input type="text" name="descripcion" value="<?php echo htmlspecialchars($row['descripcion']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="fechanac">Maestro ID:</label>
            <input type="num" name="maestro_id" value="<?php echo htmlspecialchars($row['maestro_id']); ?>" required>
        </div>
    </form>
</body>
</html>
