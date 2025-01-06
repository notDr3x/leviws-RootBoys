<?php
session_start();

// Controllo se l'utente è autenticato
if (isset($_SESSION['user_id'])) {
    // Reindirizza alla dashboard se autenticato
    header('Location: dashboard.php');
} else {
    // Reindirizza alla pagina di login se non autenticato
    header('Location: login.php');
}
exit;