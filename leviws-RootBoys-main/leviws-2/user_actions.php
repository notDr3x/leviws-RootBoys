<?php
require 'includes/db.php';
global $pdo;
$action = $_GET['action'] ?? '';

if ($action === 'read') {
    // Parametri inviati da DataTables
    $start = $_POST['start'];                           // Offset della query (da dove iniziare)
    $length = $_POST['length'];                         // Numero di record per pagina
    $searchValue = $_POST['search']['value'];           // Valore della ricerca
    $orderColumnIndex = $_POST['order'][0]['column'];   // Colonna ordinata
    $orderDirection = $_POST['order'][0]['dir'];        // Direzione ordinamento (asc/desc)

    // Array di mappatura colonne (per ordinamento)
    $columns = ['id', 'username', 'group_name'];

    if (!empty($searchValue)) {
        if (!preg_match('/^[a-zA-Z0-9_ ]*$/', $searchValue)) {
            echo json_encode([
                "draw" => intval($_POST['draw']),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            ]);
            exit;
        }
    }

    // Costruzione query principale
    $query = "SELECT u.id, u.username, g.name as group_name 
              FROM users u 
              LEFT JOIN `groups` g ON u.group_id = g.id";

    // Aggiunta filtro di ricerca
    if (!empty($searchValue)) {
        $query .= " WHERE u.username LIKE :search OR g.name LIKE :search";
    }

    // Aggiunta ordinamento
    $query .= " ORDER BY " . $columns[$orderColumnIndex] . " $orderDirection";

    // Aggiunta paginazione
    $query .= " LIMIT :start, :length";

    // Preparazione della query
    $stmt = $pdo->prepare($query);

    // Bind dei parametri
    if (!empty($searchValue)) {
        $stmt->bindValue(':search', "%$searchValue%", PDO::PARAM_STR);
    }
    $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
    $stmt->bindValue(':length', (int)$length, PDO::PARAM_INT);

    // Esecuzione della query
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Conteggio totale dei record
    $totalRecordsQuery = "SELECT COUNT(*) FROM users";
    $totalRecords = $pdo->query($totalRecordsQuery)->fetchColumn();

    // Conteggio totale con filtro
    if (!empty($searchValue)) {
        $filteredRecordsQuery = "SELECT COUNT(*) FROM users WHERE username LIKE :search";
        $stmtFiltered = $pdo->prepare($filteredRecordsQuery);
        $stmtFiltered->bindValue(':search', "%$searchValue%", PDO::PARAM_STR);
        $stmtFiltered->execute();
        $filteredRecords = $stmtFiltered->fetchColumn();
    } else {
        $filteredRecords = $totalRecords;
    }

    // Restituzione del JSON
    echo json_encode([
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $totalRecords,        // Totale record senza filtro
        "recordsFiltered" => $filteredRecords,  // Totale record filtrati
        "data" => $data                         // Dati della pagina corrente
    ]);
} elseif ($action === 'edit') {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE id = :id");
    $stmt->execute(['id' => $id]);
    echo json_encode($stmt->fetch());
} elseif ($action === 'save') {
    $id = $_POST['userId'] ?? null;
    $username = $_POST['username'];
    $password = $_POST['password'] ?? null;
    $group = $_POST['group'];

    if ($id) {
        // Aggiornamento utente
        $stmt = $pdo->prepare("UPDATE users SET username = :username, group_id = :group WHERE id = :id");
        $stmt->execute(['username' => $username, 'group' => $group, 'id' => $id]);

        if ($password) {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("UPDATE users SET password_hash = :password_hash WHERE id = :id");
            $stmt->execute(['password_hash' => $password_hash, 'id' => $id]);
        }
    } else {
        // Creazione utente
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, group_id) VALUES (:username, :password_hash, :group)");
        $stmt->execute(['username' => $username, 'password_hash' => $password_hash, 'group' => $group]);
    }
} elseif ($action === 'delete') {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
}