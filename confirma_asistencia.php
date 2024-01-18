<?php
// Validar que sea una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Configuración de la conexión a la base de datos
    $servername = "localhost";
    $username = "c2271752_invIt_A";
    $password = "81deNAdoto";
    $dbname = "c2271752_invIt_A";

    // Intentar establecer la conexión
    try {
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            throw new Exception("Error de conexión: " . $conn->connect_error);
        }

        // Obtener los datos del formulario
        $nombre = $_POST['nombre'] ?? '';
        $apellido = $_POST['apellido'] ?? '';
        $menuEspecial = isset($_POST['menuEspecial']) ? 1 : 0; // Convertir el valor del checkbox a 1 o 0
        $confirmar = $_POST['confirmar'] ?? '';

        // Validar y sanitizar los datos (Ejemplo: podrías usar funciones como mysqli_real_escape_string o prepared statements)
        // ...

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO personas (nombre, apellido, confirma, menuEspecial) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conn->error);
        }

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
            throw new Exception("Error al insertar datos: " . $stmt->error);
        }

    } catch (Exception $e) {
        // Manejar excepciones
        echo "Error: " . $e->getMessage();
    } finally {
        // Cerrar la conexión
        if (isset($conn)) {
            $stmt->close();
            $conn->close();
        }
    }
}
?>
