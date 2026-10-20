<?php

session_start();

require_once('connexion.php');


// Récupérer l'utilisateur connecté
$userId = $_SESSION['user_id'];


// Récupérer le message
$message = $_POST['message'];


// Récupérer le pseudo
$username = $_SESSION['username'];


// Enregistrer le cookie
setcookie('username', $username, time() + 86400 * 30);


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