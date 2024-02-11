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
// Incluir el archivo de conexión a la base de datos
include('includes/config/conexion.php');

// Consulta SQL para obtener datos (sustituye con tu propia consulta)
$sql = "SELECT * FROM personas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Imprimir los datos en una tabla
    echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Confirma</th>
            <th>Menú especial</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['nombre'] . "</td>
            <td>" . $row['apellido'] . "</td>
            <td>" . $row['confirma'] . "</td>
            <td>" . $row['menuEspecial'] . "</td>
        </tr>";
    }

    echo "</table>";
    
} else {
    echo "0 resultados";
}

// Consulta SQL para obtener datos (sustituye con tu propia consulta)
$sql2 = "SELECT * FROM personas WHERE menuEspecial = 1 AND confirma = 'si'";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    // Imprimir los datos en una tabla
    
    echo "
    <p> Menú especial </p>
    <table border='1'>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
        </tr>";

    while ($row = $result2->fetch_assoc()) {
        echo "<tr>
            <td>" . $row['nombre'] . "</td>
            <td>" . $row['apellido'] . "</td>
        </tr>";
    }

    echo "</table>";
    
} else {
    echo "0 resultados";
}

// Consulta SQL para obtener datos (sustituye con tu propia consulta)
$sql3 = "SELECT * FROM personas WHERE menuEspecial = 0 AND confirma = 'si'";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
    // Imprimir los datos en una tabla
    echo "
    <p> Menú común </p>
    <table border='1'>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
        </tr>";

    while ($row = $result3->fetch_assoc()) {
        echo "<tr>
            <td>" . $row['nombre'] . "</td>
            <td>" . $row['apellido'] . "</td>
        </tr>";
    }

    echo "</table>";
    
} else {
    echo "0 resultados";
}
// Cerrar la conexión a la base de datos
$conn->close();
?>

</body>
</html>