<?php
include('backend/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $curso_id = $_POST['curso_id'];

    foreach ($_POST['zona'] as $estudiante_id => $zona) {
        $examen = $_POST['examen'][$estudiante_id];
        $zona = (int)$zona;
        $examen = (int)$examen;
        $resultado_final = min($zona + $examen, 100); 
        $query = "INSERT INTO notas (estudiante_id, curso_id, zona, examen, resultado_final)
                  VALUES ('$estudiante_id', '$curso_id', '$zona', '$examen', '$resultado_final')
                  ON DUPLICATE KEY UPDATE zona = '$zona', examen = '$examen', resultado_final = '$resultado_final'";
        
        mysqli_query($conn, $query);
    }

    echo "Notas guardadas exitosamente.";
}
?>
