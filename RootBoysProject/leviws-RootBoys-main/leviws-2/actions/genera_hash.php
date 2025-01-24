<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <title>HASH</title>
    </head>

    <body>
        <?php
        $password_hash = password_hash('admin_password', PASSWORD_BCRYPT);
        echo "<p>admin password: ".$password_hash."</p>";

        $password_hash = password_hash('user_password', PASSWORD_BCRYPT);
        echo "<p>user password: ".$password_hash."</p>";
        ?>
    </body>
</html>
