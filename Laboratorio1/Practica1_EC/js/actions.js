document.addEventListener("DOMContentLoaded", function () {
    // Evento para el formulario de creación de estudiantes
    document.getElementById("studentForm").addEventListener("submit", function (e) {
        e.preventDefault();
        // Obtener y enviar datos de estudiantes
        let carnet = document.getElementById("carnet").value;
        let nombre = document.getElementById("nombre").value;
        let apellido = document.getElementById("apellido").value;
        let fechanac = document.getElementById("fechanac").value;
        enviarDatos("createE", "estudiante", { carnet, nombre, apellido, fechanac });
    });
    // Función genérica para enviar datos 
    function enviarDatos(action, entidad, data) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "backend/process.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            if (this.status == 200) {
                alert(this.responseText);
            }
        };

        let params = `action=${action}&entidad=${entidad}`;
        for (const key in data) {
            params += `&${key}=${encodeURIComponent(data[key])}`;
        }

        xhr.send(params);
    }

});

document.addEventListener("DOMContentLoaded", function () {
    // Evento para el formulario de creación de maestros
    document.getElementById("maestroForm").addEventListener("submit", function (e) {
        e.preventDefault();
        // Obtener y enviar datos 
        let numero_carnet = document.getElementById("carnet_maestro").value;
        let nombre_completo = document.getElementById("nombre_maestro").value;
        let fecha_nac = document.getElementById("fechanac_maestro").value;
        enviarDatos("createM", "maestro", { numero_carnet, nombre_completo, fecha_nac });
    });

    function enviarDatos(action, entidad, data) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "backend/process.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            if (this.status == 200) {
                alert(this.responseText);
            }
        };

        let params = `action=${action}&entidad=${entidad}`;
        for (const key in data) {
            params += `&${key}=${encodeURIComponent(data[key])}`;
        }

        xhr.send(params);
    }

});


document.addEventListener("DOMContentLoaded", function () {
    // Evento para el formulario de creación de cursos
    document.getElementById("cursoForm").addEventListener("submit", function (e) {
        e.preventDefault();
        // Obtener y enviar datos 
        let codigo = document.getElementById("codigo").value;
        let nombre = document.getElementById("nombre_curso").value;
        let descripcion = document.getElementById("descripcion_curso").value;
        let maestro_id = document.getElementById("maestro_id").value || ""; // Puede ser nulo
        enviarDatos("createC", "curso", { codigo, nombre, descripcion, maestro_id });
    });

    function enviarDatos(action, entidad, data) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "backend/process.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            if (this.status == 200) {
                alert(this.responseText);
            }
        };

        let params = `action=${action}&entidad=${entidad}`;
        for (const key in data) {
            params += `&${key}=${encodeURIComponent(data[key])}`;
        }

        xhr.send(params);
    }

});

// Lista de estudiantes
document.addEventListener("DOMContentLoaded", listarEstudiantes);

function listarEstudiantes() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/process.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (this.status == 200) {
            document.getElementById("studentList").innerHTML = this.responseText;
        }
    };

    xhr.send("action=list");
}

//Lista de Maestros
document.addEventListener("DOMContentLoaded", listarMaestros);

function listarMaestros() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/process.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (this.status == 200) {
            document.getElementById("maestrosList").innerHTML = this.responseText;
        }
    };

    xhr.send("action=listM");
}

// Función para listar cursos
document.addEventListener("DOMContentLoaded", listarCursos);

function listarCursos() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/process.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (this.status == 200) {
            document.getElementById("cursosList").innerHTML = this.responseText;
        }
    };

    xhr.send("action=listC");
}


// Función para eliminar estudiante
function eliminarEstudiante(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este estudiante?")) {
        enviarDatos("delete", "estudiante", { id: id });
    }
}

// Función para editar estudiante
function editarEstudiante(id) {
    let nombre = prompt("Ingrese el nuevo nombre:");
    let apellido = prompt("Ingrese el nuevo apellido:");
    let fechanac = prompt("Ingrese la nueva fecha de nacimiento (YYYY-MM-DD):");

    if (nombre && apellido && fechanac) {
        enviarDatos("update", "estudiante", { id: id, nombre: nombre, apellido: apellido, fechanac: fechanac });
    }
}

// Función para eliminar maestro
function eliminarMaestro(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este maestro?")) {
        enviarDatos("delete", "maestro", { id: id });
    }
}

// Función para editar maestro
function editarMaestro(id) {
    let nombre_completo = prompt("Ingrese el nuevo nombre completo:");
    let fecha_nac = prompt("Ingrese la nueva fecha de nacimiento (YYYY-MM-DD):");

    if (nombre_completo && fecha_nac) {
        enviarDatos("update", "maestro", { id: id, nombre_completo: nombre_completo, fecha_nac: fecha_nac });
    }
}

// Función para eliminar curso
function eliminarCurso(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este curso?")) {
        enviarDatos("delete", "curso", { id: id });
    }
}

// Función para editar curso
function editarCurso(id) {
    let nombre = prompt("Ingrese el nuevo nombre:");
    let descripcion = prompt("Ingrese la nueva descripción:");
    let maestro_id = prompt("Ingrese el nuevo ID de maestro:");

    if (nombre && descripcion && maestro_id) {
        enviarDatos("update", "curso", { id: id, nombre: nombre, descripcion: descripcion, maestro_id: maestro_id });
    }
}
