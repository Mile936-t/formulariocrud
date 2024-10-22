<?php
    session_start();

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit();
    }

    // Incluir archivo de conexión
    include 'conexion.php';

    // Consulta para obtener los datos
    $sql = "SELECT * FROM persona"; // Cambia esto según tu tabla
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="container mt-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevo">NUEVO</button>

        <!-- Modal para Nuevo Registro -->
        <div class="modal fade" id="modalNuevo" tabindex="-1" aria-labelledby="modalNuevoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalNuevoLabel">Nuevo Registro</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formNuevo" action="agregar.php" method="POST">
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Ingresa tu cédula" name="cedula" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Ingresa tus nombres" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" placeholder="Ingresa tu edad" name="edad" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Ingresa tu correo electrónico" name="correo" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" form="formNuevo" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <br><br>

        <div class="row mb-4">
            <div class="col-sm-12">
                <input type="text" id="search" class="form-control" placeholder="Buscar por nombre..." aria-label="Buscar" onkeyup="filterTable()">
            </div>
        </div>

        <table class="table table-bordered mt-3 table-hover">
            <thead class="table">
                <tr>
                    <th>Cédula</th>
                    <th>Nombres</th>
                    <th>Edad</th>
                    <th>Correo</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody id="data-table">
                <?php
                include "conexion.php";
                $sql = "SELECT * FROM persona";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td>' . $row['cedula'] . '</td>
                                <td>' . $row['nombre'] . '</td>
                                <td>' . $row['edad'] . '</td>
                                <td>' . $row['correo'] . '</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" onclick="editarRegistro(\'' . $row['cedula'] . '\', \'' . $row['nombre'] . '\', \'' . $row['edad'] . '\', \'' . $row['correo'] . '\')">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="confirmarEliminar(\'' . $row['cedula'] . '\')">
                                        <i class="bi bi-x-circle-fill"></i> Eliminar
                                    </button>
                                </td>
                              </tr>';
                    }
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editarRegistro(cedula, nombre, edad, correo) {
            const modal = new bootstrap.Modal(document.getElementById('modalNuevo'));
            modal.show();
            document.getElementById('formNuevo').action = 'editar.php'; // Cambiar a la acción de editar
            document.querySelector('input[name="cedula"]').value = cedula;
            document.querySelector('input[name="nombre"]').value = nombre;
            document.querySelector('input[name="edad"]').value = edad;
            document.querySelector('input[name="correo"]').value = correo;
        }

        function confirmarEliminar(cedula) {
            const modal = new bootstrap.Modal(document.getElementById('modalEliminar'));
            document.getElementById('cedulaEliminar').value = cedula;
            modal.show();
        }

        function filterTable() {
            const input = document.getElementById('search');
            const filter = input.value.toLowerCase();
            const table = document.getElementById("data-table");
            const tr = table.getElementsByTagName("tr");

            for (let i = 0; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName("td")[1]; // Solo buscar en la columna de Nombres
                if (td) {
                    const txtValue = td.textContent || td.innerText;
                    tr[i].style.display = txtValue.toLowerCase().indexOf(filter) > -1 ? "" : "none";
                }
            }
        }
    
    </script>

    <!-- Modal para Confirmar Eliminación -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminarLabel">Eliminar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este registro?
                </div>
                <div class="modal-footer">
                    <form id="formEliminar" action="eliminar.php" method="POST">
                        <input type="hidden" name="cedula" id="cedulaEliminar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
    <form action="cerrar.php" method="POST" style="display: inline;">
        <button type="submit" class="btn btn-danger">Cerrar sesión</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css"></script>
</body>
</html>
