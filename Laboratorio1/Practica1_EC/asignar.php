<?php
include('backend/database.php');
include('components/header.php');
include('components/navbar.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $curso_id = $_POST['curso_id'];
    $estudiante_id = $_POST['estudiante_id'];
    $maestro_id = $_POST['maestro_id'];
    $query = "INSERT INTO asignacion (curso_id, estudiante_id, maestro_id) VALUES ('$curso_id', " . ($estudiante_id ? "'$estudiante_id'" : "NULL") . ", " . ($maestro_id ? "'$maestro_id'" : "NULL") . ")";

    if (mysqli_query($conn, $query)) {
        echo "Asignación realizada exitosamente.";
    } else {
        echo "Error al asignar: " . mysqli_error($conn);
    }
}
?>
