<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina di esempio</title>
    <link rel="stylesheet" href="bootstrap.min.css"> <!-- Collegamento a un file CSS esterno -->
    <style>
        body{
            background-color: #2b2929;
        }
        .pad{
            text-transform: uppercase;
            margin: 0 0 0 15px;
            font-weight: 300;
            line-height: 1.02em;
            letter-spacing: 0.1em;
            color: #5c6f82;

        }

        a{
            padding-right: 10pt;
            font-weight: bold;
            color: grey;
        }
        a:hover{
            width: 10px;
        }
        a:{

        }
    </style>
</head>
<body>
<header class="navbar navbar-expand-lg navbar-black bg-white">
    <div class="container">
        <div class="header-logo-levi d-flex align-items-center">
            <img src="logo_levi.png" width="120" height="80">
            <h5 class = "pad">
                GITE
                <br>
                Viaggi
                <br>
                USCITA DIDATTICA
            </h5>
        </div>

        <div class = "collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li><a> Gestione_utente </a></li>
                <li><a> lista</a></li>
                <li><a> Pagina</a></li>
                <li><a> Contatti</a></li>

            </ul>
        </div>

    </div>

</header>
<main>
    <p>Questo è un esempio di pagina HTML di base.</p>
</main>








<footer>
    <p>&copy; 2024 Il tuo nome</p>
</footer>
<script src="script.js"></script> <!-- Collegamento a un file JavaScript esterno -->
</body>
</html>

