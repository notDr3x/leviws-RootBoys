<?php
// Avvia la sessione
session_start();

// Distruggi tutti i dati della sessione
session_unset(); // Rimuove tutte le variabili di sessione
session_destroy(); // Distrugge la sessione

// Rimuove eventuali cookie di sessione (opzionale, ma consigliato)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Reindirizza alla pagina di login
header("Location: login.php");
exit;