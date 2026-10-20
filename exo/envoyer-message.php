<?php

require_once('connexion.php');

$username = $_POST['username'];
$message = $_POST['message'];


// Enregistrer le pseudo dans un cookie
setcookie('username', $username, time() + 86400 * 30);


// Chercher l'utilisateur
$request = $db->prepare(
    'SELECT id FROM users WHERE username = ?'
);

$request->execute([$username]);

$user = $request->fetch();


// Vérifier si l'utilisateur existe déjà
if ($user) {

    $userId = $user['id'];

} else {

    // Générer une couleur pour le nouvel utilisateur
    require_once('RandomColor.php');

    $color = Colors\RandomColor::one();


    // Créer un nouvel utilisateur avec sa couleur
    $request = $db->prepare(
        'INSERT INTO users (username, color) VALUES (?, ?)'
    );

    $request->execute([
        $username,
        $color
    ]);

    // Récupérer l'id du nouvel utilisateur
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