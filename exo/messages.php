<?php

require_once('connexion.php');

$request = $db->prepare('
    SELECT messages.message, messages.created_at, users.username, users.color
    FROM messages
    INNER JOIN users ON messages.user_id = users.id
    ORDER BY messages.created_at ASC
');

$request->execute();

$messages = $request->fetchAll();

foreach ($messages as $message) {

    echo '<div class="message">';

    echo '<span class="username" style="color: ' . htmlspecialchars($message['color']) . ';">';
    echo htmlspecialchars($message['username']);
    echo '</span>';

    echo '<div class="message-content">';
    echo htmlspecialchars($message['message']);
    echo '</div>';

    echo '<small>';
    echo $message['created_at'];
    echo '</small>';

    echo '</div>';
}

?>