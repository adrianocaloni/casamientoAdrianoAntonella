<!DOCTYPE html>
<html lang="es">
<head> 
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="javascript.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> 
  <title>Back Office</title>
</head>
<body>


<?php
// Verificar si se recibió un formulario válido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pagar'])) {
    // Verificar si se recibió el ID de la persona para pagar
    if (isset($_POST['pagar'])) {
        // Conectar a la base de datos
        include('includes/config/conexion.php');

        // Obtener el ID de la persona a pagar
        $id_persona = $_POST['pagar'];

        // Preparar la consulta SQL para actualizar el estado a "pagado" para la persona seleccionada
        $sql = "UPDATE personas SET estado = 1 WHERE id = $id_persona";

        if ($conn->query($sql) === TRUE) {
            echo "Estado actualizado correctamente a 'pagado' para la persona con ID: $id_persona.";
        } else {
            echo "Error al actualizar el estado: " . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "No se recibió ID de la persona para pagar.";
    }
} else {
    // Si se intenta acceder a este script de forma directa, redireccionar a alguna página apropiada
    header("Location: index.php");
    exit();
}
?>

<form method='post' action='actualizar_estado.php'>
<?php
// El código PHP que genera la tabla y los botones va aquí
?>
</form>

<!-- Botón Volver -->
<form action="backoffice.php">
    <button type="submit" class='btn btn-secondary backoffice'>Volver</button>
</form>
</body>
</html>