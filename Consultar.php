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

    // Consultar el usuario en la base de datos
    $stmt = $conn->prepare("SELECT username, password FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_username, $db_password);
        $stmt->fetch();
        echo "Usuario encontrado: <br>";
        echo "Nombre de Usuario: " . $db_username . "<br>";
        echo "Contraseña: " . $db_password;
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
}

$conn->close();
?>
