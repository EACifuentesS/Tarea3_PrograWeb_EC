<?php
include('components/header.php');
include('components/navbar.php');
?>

<div class="container mt-4">
    <h2>Creación de Estudiantes</h2>
    <form id="studentForm"> 
        <div class="form-group">
            <label for="carnet">Carnet:</label>
            <input type="number" class="form-control" id="carnet" name="carnet" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombres:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellidos:</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="form-group">
            <label for="fechanac">Fecha De Nacimiento:</label>
            <input type="date" class="form-control" id="fechanac" name="fechanac" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>

    
</div>

<script src="js/actions.js"></script>
