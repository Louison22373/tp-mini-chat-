<?php

require_once('connexion.php');

$username = $_POST['username'];
$message = $_POST['message'];

setcookie('username', $username, time() + 86400 * 30);

// Search for the user
$request = $db->prepare(
    'SELECT id FROM users WHERE username = ?'
);

$request->execute([$username]);

$user = $request->fetch();

if ($user) {

    $userId = $user['id'];

} else {

    $request = $db->prepare(
        'INSERT INTO users (username) VALUES (?)'
    );

    $request->execute([$username]);

    $userId = $db->lastInsertId();
}

$createdAt = date('Y-m-d H:i:s');

$ipAddress = $_SERVER['REMOTE_ADDR'];

$request = $db->prepare(
    'INSERT INTO messages (user_id, message, created_at, ip_address)
     VALUES (?, ?, ?, ?)'
);

$request->execute([
    $userId,
    $message,
    $createdAt,
    $ipAddress
]);

header('Location: index.php');
exit;

?>