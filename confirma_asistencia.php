<?php
include('includes/config/conexion.php');

// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $menuEspecial = isset($_POST['menuEspecial']) ? 1 : 0;
    $confirmar = $_POST['confirmar'] ?? '';

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO personas (nombre, apellido, confirma, menuEspecial) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $apellido, $confirmar, $menuEspecial);

    if ($stmt->execute()) {
        if ($confirmar == 'si') {
            // Redireccionar a la página de confirmación
            header("Location: confirmacion.html");
            exit(); // Finalizar el script después de redireccionar
        } else {
            // Redireccionar a la página de inicio
            header("Location: noconfirma.html");
            exit(); // Finalizar el script después de redireccionar
        }
    } else {
        echo "Error al insertar datos: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
