<?php
// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    $conn = new mysqli('localhost', 'c2271752_invIt_A', '81deNAdoto', 'c2271752_invIt_A');

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $menuEspecial = isset($_POST['menuEspecial']) ? 1 : 0; // Convertir el valor del checkbox a 1 o 0
    $confirmar = $_POST['confirmar'] ?? '';

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO Personas (nombre, apellido, confirma, menuEspecial) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $apellido, $confirmar, $menuEspecial);
    
    if ($stmt->execute()) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar datos: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>