<?php
session_start();

require '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manda Prosposte</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/datatables.min.css">
    <link rel="stylesheet" href="../assets/css/send_proposer.css">
</head>
<body>
<div class="static">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <li class="nav-item"><img src="../assets/img/logoLevi.png" href = "dashboard.php" alt="immagine logo levi dashboard" id = "logo_levi_img"></li>
            <li class="nav-item"><a href="dashboard.php" class="nav-link"><img src="../assets/img/iosArrow.png" id = "iosArrow_img"></a></li>
            <!-- Icona "Logout" -->
            <div class="text-center me-3">
                <a href="../actions/logout.php">
                    <img src="../assets/img/logout.png" alt="Logout" id="logout_img" style="width: 36px; height: 36px;">
                </a>
                <div class="mt-2">
                    <a href="logout.php" style="text-decoration: none; color: #999; font-size: 0.9em;">Logout</a>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="body">
    <form class ="form"  action="" METHOD="CREATE">
        <h1>Proposta</h1>
        <div class="form_container">
            <div class="form-group">
                <input type="text"  class="input" id="exampleInputEmail1" placeholder="Destinazione">
            </div>
            <div class="form-group ">
                <input type="text" class="input" id="exampleInputPassword1" placeholder="Accompagnatori">
            </div>
            <div class="form-group ">
                <input type="text"  class="input" id="exampleInputPassword1" placeholder="Docente sost.">
            </div>
            <div class="form-group ">
                <input type="text"  class="input" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group ">
                <select type=""  class="input" id="exampleInputPassword1" placeholder="Obiettivi didattici"></select>
            </div>
            <div class="form-group ">
                <input type="datetime-local"  class="input" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <textarea class="input" id="outPutTextarea" rows="3" placeholder="Descrizione"></textarea>

            </div>
        </div>


        <br>

        <br><button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>