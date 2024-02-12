<?php
// Conexión a la base de datos
include('includes/config/conexion.php');

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el tipo de persona seleccionado y el ID de la persona
    if(isset($_POST['tipo_persona'], $_POST['id_persona']) && is_array($_POST['tipo_persona']) && is_array($_POST['id_persona'])) {
        // Recorrer los arrays para obtener el tipo de persona y el ID de la persona
        foreach($_POST['tipo_persona'] as $index => $tipoPersonaSeleccionado) {
            $id_persona = $_POST['id_persona'][$index];
            // Actualizar la tabla de personas con el tipo de menú seleccionado
            $sql_actualizar = "UPDATE personas SET adulto_menor = ? WHERE id = ? AND confirma = 'si'";
            $stmt = $conn->prepare($sql_actualizar);
            $stmt->bind_param("ii", $tipoPersonaSeleccionado, $id_persona);
            $stmt->execute();

            // Verificar si la actualización fue exitosa
            if ($stmt->affected_rows > 0) {
                echo "¡Actualización exitosa para la persona con ID $id_persona!<br>";
            } else {
                echo "No se pudo actualizar la persona con ID $id_persona.<br>";
            }
        }
        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "No se seleccionó ningún tipo de menú o no se recibió el ID de la persona.";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
