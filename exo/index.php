<?php

require_once('connexion.php');

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

        <div class="messages" id="messages">

        </div>

        <form id="message-form" action="envoyer-message.php" method="POST">

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

<script>

function refreshMessages() {

    fetch('messages.php')
        .then(response => response.text())
        .then(data => {

            document.getElementById('messages').innerHTML = data;

        });

}

refreshMessages();

setInterval(refreshMessages, 2000);


document.getElementById('message-form').addEventListener('submit', function(event) {

    event.preventDefault();

    const formData = new FormData(this);

    fetch('envoyer-message.php', {
        method: 'POST',
        body: formData
    })
    .then(() => {

        this.reset();

        refreshMessages();

    });

});

</script>

</body>

</html>