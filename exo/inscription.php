<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inscription</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="chat-container">

    <div class="main-area">

        <h1>Créer un compte</h1>

        <form action="traitement-inscription.php" method="POST">

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
                S'inscrire
            </button>

        </form>

        <p>
            Déjà un compte ?
            <a href="connexion-utilisateur.php">Se connecter</a>
        </p>

    </div>

</div>

</body>

</html>