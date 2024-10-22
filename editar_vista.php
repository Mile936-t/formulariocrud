<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
<body>
    <?php
    $cedula = $_GET["cedula"];
    $nombre = $_GET["nombre"];
    $edad = $_GET["edad"];
    $correo = $_GET["correo"];
    ?>
    <div class="container mt-2">
      

   
        <form action="editar.php" method="POST">
            <div class="mb-3">
                <input type="text" class="form-control" name="cedula" value="<?php echo $cedula; ?>" readonly>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>">
            </div>
            <div class="mb-3">
                <input type="number" class="form-control"  name="edad" value="<?php echo $edad; ?>">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control"  name="correo" value="<?php echo $correo; ?>">
            </div>
            
            <button type="submit" class="btn btn-primary" id="guardarBtn">
                <i class="bi bi-pencil-square"></i></i> Editar
            </button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css"></script>

</body>
</html>