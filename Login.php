<?php
session_start();
$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "guarderia_y_estetica_de_mascotas";

// Crear la conexión
$conn = new mysqli($servername, $user, $pass, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_input = $_POST['username'];
    $password_input = $_POST['password'];

    // Preparar la consulta para obtener los datos del usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password_input, $user['password'])) {
            // Inicio de sesión exitoso, crear sesión
            $_SESSION['username'] = $user['username'];
            $_SESSION['isLoggedIn'] = true;
            echo "Login exitoso!";
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}

$conn->close();
?>
