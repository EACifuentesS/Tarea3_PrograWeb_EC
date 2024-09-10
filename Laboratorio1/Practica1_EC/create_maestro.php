<?php
include('components/header.php');
include('components/navbar.php');
?>

<div class="container mt-4">
    <h2>Creación de Maestros</h2>
    <form id="maestroForm"> 
        <div class="form-group">
            <label for="carnet">Carnet:</label>
            <input type="number" class="form-control" id="carnet_maestro" name="carnet_maestro" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre Completo:</label>
            <input type="text" class="form-control" id="nombre_maestro" name="nombre_maestro" required>
        </div>
        <div class="form-group">
            <label for="fechanac">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="fechanac_maestro" name="fechanac_maestro" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
<script src="js/actions.js"></script>
