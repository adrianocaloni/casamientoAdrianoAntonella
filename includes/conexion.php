<?php

$dbhost = 'localhost';
$dbuser = 'c2271752_invIt_A';
$dbpass = '81deNAdoto';
$dbname = 'c2271752_invIt_A';

// Crear conexión
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "¡Conexión exitosa!";

// No es necesario cerrar la conexión inmediatamente después de establecerla.
// $conn->close();

?>