<?php
session_start();
global $pdo;
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'includes/db.php';
require 'includes/functions.php';

$userGroupId = $_SESSION['group_id'];
$canAccessSettings = checkPermission($pdo, $userGroupId, 'access_settings');
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styleDashboard.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <img src="assets/img/logoLevi.png" href = "dashboard.php" alt="immagine logo levi dashboard" id = "logo_levi_img">
        <h5 class = "pad">
            Gite
            <br>
            Viaggi
            <br>
            Uscite Didattiche
        </h5>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <?php if ($canAccessSettings): ?>
                    <li class="nav-item"><a href="manage_users.php" class="nav-link">Gestione utenti</a></li>
                <?php endif; ?>
                <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="assets/img/fotoLevi.jpg" alt="Prima immagine - Levi">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/fotoLevi.jpg" alt="Seconda immagine - Levi">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/xnq8npvo.png" alt="Terza immagine - Bambino">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<script src="assets/js/jquery-3.7.1.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>

<div class="container mt-5">
    <h1>Welcome to the Dashboard</h1>
    <p>This is an example menu based on user permissions.</p>
</div>


</body>
</html>