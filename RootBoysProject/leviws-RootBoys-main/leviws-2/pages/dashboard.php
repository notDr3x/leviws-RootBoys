<?php
session_start();
global $pdo;
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require '../includes/db.php';
require '../includes/functions.php';

$userGroupId = $_SESSION['group_id'];
$canAccessSettings = checkPermission($pdo, $userGroupId, 'access_settings');
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Collegamento a Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

        <title>Dashboard</title>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/styleDashboard.css">

    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <div class="testa">
                    <img src="../assets/img/logoLevi.png" href = "dashboard.php" alt="immagine logo levi dashboard" id = "logo_levi_img">
                    <h5 class = "pad">
                        Gite
                        <br>
                        Viaggi
                        <br>
                        Uscite Didattiche
                    </h5>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <?php if ($canAccessSettings): ?>
                            <!-- Icona "Nuovo" con Dropdown -->
                            <div class="text-center me-3 dropdown">
                                <a href="#" id="newDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../assets/img/new-document2.png" alt="Nuovo" id="new_img" style="width: 36px; height: 36px;">
                                </a>
                                <div class="mt-2">
                                    <a href="#" style="text-decoration: none; color: #999; font-size: 0.9em;">Nuovo</a>
                                </div>
                                <ul class="dropdown-menu" aria-labelledby="newDropdown">
                                    <li><a class="dropdown-item" href="send_proposer.php">Proposta</a></li>
                                    <li><a class="dropdown-item" href="#">Modulo</a></li>
                                    <li><a class="dropdown-item" href="#">Relazione</a></li>
                                </ul>
                            </div>

                            <!-- Icona "Gestisci" con Dropdown -->
                            <div class="text-center me-3 dropdown">
                                <a href="#" id="manageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../assets/img/manage.png" alt="Gestisci" id="manage_img" style="width: 36px; height: 36px;">
                                </a>
                                <div class="mt-2">
                                    <a href="#" style="text-decoration: none; color: #999; font-size: 0.9em;">Gestisci</a>
                                </div>
                                <ul class="dropdown-menu" aria-labelledby="manageDropdown">
                                    <li><a class="dropdown-item" href="manage_users.php"> Gestisci Utenti</a></li>
                                    <li><a class="dropdown-item" href="#"> Gestisci Proposte</a></li>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Icona "Logout" -->
                        <div class="text-center me-3">
                            <a href="../actions/logout.php">
                                <img src="../assets/img/logout.png" alt="Logout" id="logout_img" style="width: 36px; height: 36px;">
                            </a>
                            <div class="mt-2">
                                <a href="../actions/logout.php" style="text-decoration: none; color: #999; font-size: 0.9em;">Logout</a>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="../assets/img/fotoLevi0.png" alt="Prima immagine - Levi">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="../assets/img/fotoLevi2.png" alt="Seconda immagine - Levi">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="../assets/img/fotoLevi3.png" alt="Terza immagine - Levi">
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

        <script src="../assets/js/jquery-3.7.1.js"></script>
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>

        <div class="container mt-5">
            <h1>Welcome to the Dashboard</h1>
            <p>This is an example menu based on user permissions.</p>
        </div>
    </body>
</html>