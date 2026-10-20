<?php

require_once('connexion.php');

$request = $db->prepare('
SELECT messages.message, messages.created_at, users.username
FROM messages
INNER JOIN users ON messages.user_id = users.id
ORDER BY messages.created_at ASC
');

$request->execute();

$messages = $request->fetchAll();

$request = $db->prepare('
SELECT username
FROM users
ORDER BY username ASC
');

$request->execute();

$users = $request->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Mini Chat</title>

<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

</head>

<body>

<div class="chat-container">

    <div class="main-area">

        <h1>Welcome</h1>

        <div class="messages">

            <?php foreach ($messages as $message): ?>

                <div class="message">

                    <span class="username">
                        <?= htmlspecialchars($message['username']) ?>
                    </span>

                    <div class="message-content">
                        <?= htmlspecialchars($message['message']) ?>
                    </div>

                    <small>
                        <?= $message['created_at'] ?>
                    </small>

                </div>

            <?php endforeach; ?>

        </div>

        <form action="envoyer-message.php" method="POST">

            <input
    type="text"
    name="username"
    placeholder="Username"
    value="<?= isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : '' ?>"
    required
>

            <input
                type="text"
                name="message"
                placeholder="Write a message..."
                required
            >

            <button type="submit">
                Send
            </button>

        </form>

    </div>

    <div class="users-area">

        <h2>Connected users</h2>

        <?php foreach ($users as $user): ?>

            <div class="user">
                <?= htmlspecialchars($user['username']) ?>
            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>

</html>