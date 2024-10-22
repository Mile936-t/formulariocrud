<?php
    session_start();
    
    // Recibir los datos del formulario
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Incluir el archivo de conexión
    include 'conexion.php';

    // Consulta segura con prepared statements
    $sql = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contraseña = ?");
    $sql->bind_param("ss", $usuario, $contraseña);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows === 1) {
        // Usuario autenticado correctamente
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php'); // Redirigir a la página del formulario
        exit();
    } else {
        // Credenciales incorrectas
        header('Location: login.php?error=1');
        exit();
    }
?>
