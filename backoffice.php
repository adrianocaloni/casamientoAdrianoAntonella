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
$sql = "SELECT * FROM personas WHERE confirma = 'si'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Imprimir los datos en una tabla
    echo "<table border='1'>
        <tr>
            <th>Nombre completo</th>
            <th>Menú especial</th>
            <th>Adulto | Niño <th>
            <th>Comentario</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        // Concatenar nombre y apellido
        $nombreCompleto = $row['nombre'] . " " . $row['apellido'];
        echo "<tr>
            <td>" . $nombreCompleto . "</td>
            <td>" . $row['menuEspecial'] . "</td>
            <td>
            <select>
                <option value='adulto'>Adulto</option>
                <option value='nino'>Niño</option>
            </select>
            <td>
            <td>
                <input type='text' name='comentario'>
            </td>
        </tr>";
    }

    echo "</table>";
    
     // Agregar el botón "Guardar"
     echo "<br><button type='submit'>Guardar</button>";
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

// Cantidad de invitados
$sql4= "SELECT COUNT(*) AS cantidadInvitados FROM personas WHERE  confirma = 'si'";
$result4 = $conn->query($sql4);

if ($result4->num_rows > 0) {
    // Mostrar la cantidad de invitados
    while ($row = $result4->fetch_assoc()) {
        echo "<p>Cantidad de invitados: " . $row["cantidadInvitados"] . "</p>";
    }
} else {
    echo "0 resultados";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

</body>
</html>