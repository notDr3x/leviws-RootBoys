<?php
session_start();

// Controlla se l'utente è admin, Luca sei stupido
if ($_SESSION['group_id'] !== 1) { // Supponendo che il gruppo admin abbia ID 1
    header('Location: dashboard.php');
    exit;
}

require '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestione Utenti</title>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/datatables.min.css">
        <link rel="stylesheet" href="../assets/css/styleDashboard.css">
    </head>

    <body>
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
                        <a href="../actions/logout.php" style="text-decoration: none; color: #999; font-size: 0.9em;">Logout</a>
                    </div>
                </div>
        </nav>
        <div class="container mt-5">
            <h1 class="mb-4">Gestione Utenti</h1>
            <button id="addUser" class="btn btn-primary mb-3">Aggiungi Utente</button>
            <table id="usersTable" class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Gruppo</th>
                    <th>Azioni</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Gruppo</th>
                    <th>Azioni</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <!-- Modale per Creazione/Modifica Utenti -->
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="userForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userModalLabel">Gestisci Utente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="userId" name="userId">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="group" class="form-label">Gruppo</label>
                                <select id="group" name="group" class="form-select">
                                    <option value="1">Admin</option>
                                    <option value="2">Utente</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                            <button type="submit" class="btn btn-primary">Salva</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="../assets/js/jquery-3.7.1.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/datatables.min.js"></script>
        <script src="../assets/js/dataTables.bootstrap5.js"></script>
        <script>
            $(document).ready(function() {
                // Inizializza DataTables
                const table = $('#usersTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "../actions/user_actions.php?action=read", // Script PHP per ottenere i dati
                        "type": "POST"
                    },
                    "columns": [
                        {"data": "id"},
                        {"data": "username"},
                        {"data": "group_name"},
                        {
                            "data": 'id',
                            render: function (data) {
                                return `
                                    <button class="btn btn-sm btn-warning editUser" data-id="${data}">Modifica</button>
                                    <button class="btn btn-sm btn-danger deleteUser" data-id="${data}">Elimina</button>
                                `;
                            }
                        }
                    ],
                    paging: true,
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50],  // Opzioni di paginazione
                    language: {                   // Testo personalizzato per l'interfaccia
                        "url": "../includes/it-IT.json"
                    }
                });

                // Aggiungi utente
                $('#addUser').on('click', function() {
                    $('#userForm')[0].reset();
                    $('#userId').val('');
                    $('#userModal').modal('show');
                });

                // Modifica utente
                table.on('click', '.editUser', function() {
                    const userId = $(this).data('id');
                    $.get('user_actions.php?action=edit&id=' + userId, function(data) {
                        const user = JSON.parse(data);
                        $('#userId').val(user.id);
                        $('#username').val(user.username);
                        $('#group').val(user.group_id);
                        $('#userModal').modal('show');
                    });
                });

                // Elimina utente
                table.on('click', '.deleteUser', function() {
                    const userId = $(this).data('id');
                    const username = $(this).parents('tr').find('td:eq(1)').text();
                    if (confirm('Sei sicuro di voler eliminare l\'utente: '+username+'?')) {
                        $.post('user_actions.php?action=delete', { id: userId }, function() {
                            table.ajax.reload();
                        });
                    }
                });

                // Salva utente (Creazione o Modifica)
                $('#userForm').on('submit', function(e) {
                    e.preventDefault();
                    const formData = $(this).serialize();
                    $.post('user_actions.php?action=save', formData, function() {
                        $('#userModal').modal('hide');
                        table.ajax.reload();
                    });
                });
            });
        </script>
    </body>
</html>