<?php

session_start();

require_once('connexion.php');


$userId = $_SESSION['user_id'];


$message = $_POST['message'];


$username = $_SESSION['username'];


setcookie('username', $username, time() + 86400 * 30);


// Date et heure
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

?>
