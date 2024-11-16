<?php
$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "guarderia_y_estetica_de_mascotas";

$conn = new mysqli($servername, $user, $pass, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insertar el nuevo usuario en la base de datos
    $stmt = $conn->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Usuario registrado con éxito!";
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
