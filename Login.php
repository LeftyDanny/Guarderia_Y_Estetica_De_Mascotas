<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guarderia_y_estetica_de_mascotas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Login exitoso!";
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}

$conn->close();
?>