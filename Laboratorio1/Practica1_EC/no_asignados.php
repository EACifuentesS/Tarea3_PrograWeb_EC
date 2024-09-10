<?php
include('backend/database.php');
include('backend/database.php');
include('components/header.php');
include('components/navbar.php');

$estudiantes_no_asignados = "SELECT * FROM estudiante WHERE numero_carnet NOT IN (SELECT estudiante_id FROM asignacion WHERE estudiante_id IS NOT NULL)";
$maestros_no_asignados = "SELECT * FROM maestro WHERE numero_carnet NOT IN (SELECT maestro_id FROM asignacion WHERE maestro_id IS NOT NULL)";

$result_estudiantes = mysqli_query($conn, $estudiantes_no_asignados);
$result_maestros = mysqli_query($conn, $maestros_no_asignados);
?>

<h2>Elementos No Asignados</h2>
<h3>Estudiantes sin Curso</h3>
<table class="table">
    <tr>
        <th>Nombre</th>
        <th>Apellido</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result_estudiantes)) { ?>
    <tr>
        <td><?php echo $row['nombre']; ?></td>
        <td><?php echo $row['apellido']; ?></td>
    </tr>
    <?php } ?>
</table>

<h3>Maestros sin Curso</h3>
<table class="table">
    <tr>
        <th>Nombre Completo</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result_maestros)) { ?>
    <tr>
        <td><?php echo $row['nombre_completo']; ?></td>
    </tr>
    <?php } ?>
</table>
