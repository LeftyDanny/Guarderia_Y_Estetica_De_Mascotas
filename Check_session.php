<?php
session_start();

// Verificar si la sesión está activa
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    echo json_encode(['isLoggedIn' => true]);
} else {
    echo json_encode(['isLoggedIn' => false]);
}
?>
