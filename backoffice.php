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

// Consulta SQL para obtener datos de personas y sus valores de tarjeta
$sql = "SELECT p.nombre, p.apellido, p.menuEspecial, p.adulto_menor, vt.valor_uno, tm.descripcion
        FROM personas AS p
        INNER JOIN valor_tarjeta AS vt ON vt.id = p.adulto_menor
        LEFT JOIN tipo_menu AS tm ON tm.id = p.id_tipo_menu
        WHERE p.confirma = 'si'";

$result = $conn->query($sql);

// Inicializar variables para sumatoria y conteo
$total_valor_uno = 0;
$cantidad_invitados = 0;


if ($result->num_rows > 0) {
    // Imprimir los datos en una tabla
    echo "<table class='table table-striped'>
            <thead>
                <th>Nombre</th>
                <th>Menú especial</th>
                <th>Tipo Menú</th>
                <th>Persona</th>
                <th>Valor</th>        
            </thead>";

    while ($row = $result->fetch_assoc()) {
        // Concatenar nombre y apellido
        $nombreCompleto = $row['nombre'] . " " . $row['apellido'];
        echo "<tr>
                <td>$nombreCompleto</td>
                <td>";
        // Verificar si menuEspecial es "si" o "no" y mostrar el texto correspondiente
        echo ($row['menuEspecial'] == '1') ? "Sí" : "No";
        echo "</td>
                <td>{$row['descripcion']}</td>           
                <td>";
        // Generar opciones para las personas (ADULTO - MENOR)
        echo ($row['adulto_menor'] == '1') ? "Adulto" : "Niño";
        echo "</td>
                <td>{$row['valor_uno']}</td>
              </tr>";
         // Sumar el valor_uno al total
        $total_valor_uno += $row['valor_uno'];

        // Contar el número de invitados
        $cantidad_invitados++;
    }
    echo "</table>";
    // Imprimir la sumatoria total de valor_uno y la cantidad de invitados
     echo "<p style='text-align: right;'><b>Total $:</b> $total_valor_uno</p>";
     echo "<p style='text-align: right;'><b>Cantidad de invitados:</b> $cantidad_invitados</p>";

} else {
    echo "0 resultados";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<form action="carga_adulto_menor.php" method="post">
    <?php
    // Incluir el archivo de conexión a la base de datos
    include('includes/config/conexion.php');

    // Consulta SQL para obtener datos
    $sql = "SELECT * FROM personas WHERE confirma = 'si' AND adulto_menor IS NULL OR adulto_menor = 0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Imprimir los datos en una tabla
        echo "
        <table class='table table-striped'>
            <thead>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Adulto | Menor</th>
            </thead>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['nombre'] . "</td>
                <td>" . $row['apellido'] . "</td>
                <td>
                    <select name='tipo_persona[]'>
                        <option value='0'>-</option>
                        <option value='1'>Adulto</option>
                        <option value='2'>Menor</option>
                    </select>
                    <!-- Campo oculto para enviar el ID de la persona -->
                    <input type='hidden' name='id_persona[]' value='" . $row['id'] . "'>
                </td>
            </tr>";
        }

        echo "</table>";
         // Agregar el botón "Guardar"
         echo "<br><button type='submit' class='btn btn-secondary backoffice'>Guardar</button> <br><br>";
    } else {
        echo "Personas pendientes de cargar: 0";
    }
    ?>
</form>

<form action="carga_tipo_especial.php" method="post">
    <?php
    // Incluir el archivo de conexión a la base de datos
    include('includes/config/conexion.php');

    // Consulta SQL para obtener datos
    $sql2 = "SELECT * FROM personas WHERE menuEspecial = 1 AND confirma = 'si'";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        // Imprimir los datos en una tabla
        echo "
        <table class='table table-striped'>
            <thead>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Tipo Menú</th>
            </thead>";

        while ($row = $result2->fetch_assoc()) {
            echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['nombre'] . "</td>
                <td>" . $row['apellido'] . "</td>
                <td>
                    <select name='tipo_menu[]'>
                        <option value='0'>-</option>
                        <option value='1'>Celíaco</option>
                        <option value='2'>Sin Gluten</option>
                        <option value='3'>Vegetariano</option>
                        <option value='4'>Vegano</option>
                    </select>
                    <!-- Campo oculto para enviar el ID de la persona -->
                    <input type='hidden' name='id_persona[]' value='" . $row['id'] . "'>
                </td>
            </tr>";
        }

        echo "</table>";
         // Agregar el botón "Guardar"
         echo "<br><button type='submit' class='btn btn-secondary backoffice'>Guardar</button> <br><br>";
    } else {
        echo "Personas con Menú Espacial: 0";
    }
    ?>
</form>
</body>
</html>