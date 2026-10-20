<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Connexion</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="chat-container">

    <div class="main-area">

        <h1>Connexion</h1>

        <form action="traitement-connexion.php" method="POST">

            <input
                type="text"
                name="username"
                placeholder="Username"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Mot de passe"
                required
            >

            <button type="submit">
                Se connecter
            </button>

        </form>

        <p>
            Pas encore de compte ?
            <a href="inscription.php">Créer un compte</a>
        </p>

    </div>

</div>

</body>

</html>