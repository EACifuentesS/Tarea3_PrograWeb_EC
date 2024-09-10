Esta aplicación web permite gestionar la asignación de estudiantes y maestros a cursos en un colegio, así como administrar y visualizar las notas de los estudiantes. 

## Funcionalidades Principales

### 1. **Asignación de Estudiantes y Maestros a Cursos**

- **Descripción**: Esta funcionalidad permite asignar estudiantes y maestros a diferentes cursos disponibles en la base de datos.
- **Cómo se hace**: 
  - En la página de asignación (`asignar.php`), selecciona un curso, un estudiante y/o un maestro de los menús desplegables.
  - Haz clic en el botón "Asignar" para guardar la asignación en la base de datos.

### 2. **Registro de Notas**

- **Descripción**: Los maestros pueden registrar las notas de los estudiantes a los que están asignados. Las notas se dividen en dos componentes: "zona" (que representa el 60% del total) y "examen" (que representa el 40% del total).
- **Cómo se hace**: 
  - Navega a la sección de registro de notas.
  - Selecciona el curso y el estudiante correspondiente.
  - Ingresa las notas de "zona" y "examen". La aplicación calculará automáticamente la nota final sobre 100.

### 3. **Consulta de Notas de Estudiantes**

- **Descripción**: Permite visualizar las notas de cada estudiante para cada curso.
- **Cómo se hace**: 
  - Navega a la sección de consulta de notas.
  - Selecciona el curso o estudiante deseado para ver todas las notas registradas.

## Cómo Utilizar la Aplicación

1. **Acceso a la Aplicación**: Abre tu navegador web y navega a la URL donde está alojada la aplicación

2. **Asignar Estudiantes y Maestros**:
   - Ve a la página de asignación de cursos.
   - Selecciona el curso, estudiante y maestro deseados y haz clic en "Asignar".

3. **Registrar Notas**:
   - Los maestros deben ir a la sección de registro de notas.
   - Seleccionar el curso y el estudiante asignado.
   - Ingresar las notas de "zona" y "examen" para cada estudiante.

4. **Consultar Notas**:
   - Los administradores o maestros pueden ir a la sección de consulta de notas.
   - Seleccionar el curso o el estudiante para ver las notas registradas.

## Información Adicional

- Esta aplicación requiere un servidor web con soporte para PHP y MySQL para funcionar correctamente.
- Todos los datos son almacenados en la base de datos MySQL, y la aplicación utiliza consultas SQL para manejar la información.
