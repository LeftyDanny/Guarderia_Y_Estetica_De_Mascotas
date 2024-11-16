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
    $new_password = $_POST['new_password'];

    // Actualizar la contraseña del usuario
    $stmt = $conn->prepare("UPDATE usuarios SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $new_password, $username);

    if ($stmt->execute()) {
        echo "Contraseña actualizada con éxito!";
    } else {
        echo "Error al actualizar la contraseña: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
