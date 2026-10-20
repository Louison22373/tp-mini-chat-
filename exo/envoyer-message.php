<?php

require_once('connexion.php');

$username = $_POST['username'];
$message = $_POST['message'];

setcookie('username', $username, time() + 86400 * 30);

// Chercher l'utilisateur
$request = $db->prepare(
    'SELECT id FROM users WHERE username = ?'
);

$request->execute([$username]);

$user = $request->fetch();


// Si l'utilisateur existe
if ($user) {

    $userId = $user['id'];

} else {

    // Créer un nouvel utilisateur
    $request = $db->prepare(
        'INSERT INTO users (username) VALUES (?)'
    );

    $request->execute([$username]);

    $userId = $db->lastInsertId();
}


// Date et heure
$createdAt = date('Y-m-d H:i:s');


// Adresse IP
$ipAddress = $_SERVER['REMOTE_ADDR'];


// Enregistrer le message
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

?>