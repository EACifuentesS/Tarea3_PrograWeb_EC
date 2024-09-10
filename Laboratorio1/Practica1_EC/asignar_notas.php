<?php
include('backend/database.php');
include('components/header.php');
include('components/navbar.php');

if (isset($_GET['curso_id'])) {
    $curso_id = $_GET['curso_id'];
    $query = "SELECT e.numero_carnet, e.nombre, e.apellido FROM estudiante e
              INNER JOIN asignaciones a ON e.numero_carnet = a.estudiante_id
              WHERE a.curso_id = '$curso_id'";
    $estudiantes = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignación de Notas</title>
</head>
<body>
    <h2>Asignación de Notas para el Curso</h2>
    <form action="guardar_notas.php" method="POST">
        <input type="hidden" name="curso_id" value="<?php echo $curso_id; ?>">
        <table>
            <tr>
                <th>Estudiante</th>
                <th>Zona (0-60)</th>
                <th>Examen (0-40)</th>
                <th>Resultado Final</th>
            </tr>
            <?php while ($estudiante = mysqli_fetch_assoc($estudiantes)) { ?>
            <tr>
                <td><?php echo $estudiante['nombre'] . ' ' . $estudiante['apellido']; ?></td>
                <td><input type="number" name="zona[<?php echo $estudiante['numero_carnet']; ?>]" max="60" required></td>
                <td><input type="number" name="examen[<?php echo $estudiante['numero_carnet']; ?>]" max="40" required></td>
                <td><span id="resultado_<?php echo $estudiante['numero_carnet']; ?>">0</span></td>
            </tr>
            <?php } ?>
        </table>
        <button type="submit">Guardar Notas</button>
    </form>
    
    <script>
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                const row = this.closest('tr');
                const zona = row.querySelector('input[name^="zona"]').value || 0;
                const examen = row.querySelector('input[name^="examen"]').value || 0;
                const resultado = parseInt(zona) + parseInt(examen);
                row.querySelector('span[id^="resultado"]').textContent = resultado > 100 ? 100 : resultado;
            });
        });
    </script>
</body>
</html>
