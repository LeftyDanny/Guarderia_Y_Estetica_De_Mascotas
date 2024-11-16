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

    // Eliminar el usuario de la base de datos
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        echo "Usuario eliminado con éxito!";
    } else {
        echo "Error al eliminar el usuario: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
