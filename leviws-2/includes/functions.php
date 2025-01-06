<?php
function loginUser($pdo, $username, $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['group_id'] = $user['group_id'];
        return true;
    }
    return false;
}

function checkPermission($pdo, $userGroupId, $permission) {
    $stmt = $pdo->prepare("SELECT permissions FROM groups WHERE id = :group_id");
    $stmt->execute(['group_id' => $userGroupId]);
    $group = $stmt->fetch();

    $permissions = json_decode($group['permissions'], true);
    return in_array($permission, $permissions);
}