<?php
session_start();

// Destruir la sesión
session_unset();  // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirigir al usuario a la página de inicio o a login
header("Location: login.html");  // Redirige a la página de login
exit();
?>
