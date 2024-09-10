<?php
include('backend/database.php');
include('components/header.php');
include('components/navbar.php');

$query = "SELECT curso.nombre AS curso_nombre, estudiante.nombre AS estudiante_nombre, maestro.nombre_completo AS maestro_nombre 
          FROM asignacion 
          LEFT JOIN curso ON asignacion.curso_id = curso.codigo
          LEFT JOIN estudiante ON asignacion.estudiante_id = estudiante.numero_carnet
          LEFT JOIN maestro ON asignacion.maestro_id = maestro.numero_carnet";
$result = mysqli_query($conn, $query);
?>

<h2>Asignaciones</h2>
<table class="table">
    <tr>
        <th>Curso</th>
        <th>Estudiante</th>
        <th>Maestro</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['curso_nombre']; ?></td>
        <td><?php echo $row['estudiante_nombre'] ?? 'Sin Asignar'; ?></td>
        <td><?php echo $row['maestro_nombre'] ?? 'Sin Asignar'; ?></td>
    </tr>
    <?php } ?>
</table>
