<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guarderia_y_estetica_de_mascotas";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

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

        // Comparar la contraseña directamente sin usar hash
        if ($password_input === $user['password']) {
            // Inicio de sesión exitoso, crear sesión
            $_SESSION['username'] = $user['username'];
            $_SESSION['isLoggedIn'] = true;
            
            // Enviar respuesta exitosa en formato JSON
            echo json_encode(["success" => true, "message" => "Login exitoso!"]);
            exit(); // Termina la ejecución
        } else {
            echo json_encode(["success" => false, "message" => "Contraseña incorrecta."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Usuario no encontrado."]);
    }
}

$conn->close();
?>
