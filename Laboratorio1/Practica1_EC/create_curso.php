<?php
include('components/header.php');
include('components/navbar.php');
?>

<div class="container mt-4">
    <h2>Creación de Cursos</h2>
    <form id="cursoForm">
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre del Curso:</label>
            <input type="text" class="form-control" id="nombre_curso" name="nombre_curso" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input type="text" class="form-control" id="descripcion_curso" name="descripcion_curso" required>
        </div>
        <div class="form-group">
            <label for="maestro">ID del Maestro:</label>
            <input type="number" class="form-control" id="maestro_id" name="maestro_id">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<script src="js/actions.js"></script>
