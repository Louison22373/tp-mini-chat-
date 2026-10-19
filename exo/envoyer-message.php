<?php

require_once('connexion.php');

$username = $_POST['username'];
$message = $_POST['message'];


// Search for the user
$request = $db->prepare(
    'SELECT id FROM users WHERE username = ?'
);

$request->execute([$username]);

$user = $request->fetch();


// Check if the user already exists
if ($user) {

    $userId = $user['id'];

} else {

    // Create a new user
    $request = $db->prepare(
        'INSERT INTO users (username) VALUES (?)'
    );

    $request->execute([$username]);

    // Get the new user's ID
    $userId = $db->lastInsertId();
}


// Get the current date and time
$createdAt = date('Y-m-d H:i:s');


// Get the user's IP address
$ipAddress = $_SERVER['REMOTE_ADDR'];


// Save the message
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


// Return to the chat
header('Location: index.php');
exit;

?>