<?php
// Configurazione dei parametri di connessione
global $pdo;
$host = 'localhost'; // Host del server MySQL
$dbname = 'leviws2'; // Nome del database
$username = 'root'; // Username per l'accesso
$password = ''; // Password per l'accesso
$port = 3306; // Porta del server MySQL

try {
    // Connessione al database con il parametro della porta
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}