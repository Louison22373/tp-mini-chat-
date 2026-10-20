<?php

require_once('connexion.php');

$username = $_POST['username'];
$password = $_POST['password'];


// Vérifier si le pseudo existe déjà
$request = $db->prepare(
    'SELECT id FROM users WHERE username = ?'
);

$request->execute([$username]);

$user = $request->fetch();


// Si le pseudo existe déjà
if ($user) {

    echo 'Ce pseudo existe déjà.';
    exit;

}


// Sécuriser le mot de passe
$passwordHash = password_hash($password, PASSWORD_DEFAULT);


// Créer le compte
$request = $db->prepare(
    'INSERT INTO users (username, password) VALUES (?, ?)'
);

$request->execute([
    $username,
    $passwordHash
]);


// Aller vers la page de connexion
header('Location: connexion-utilisateur.php');
exit;

?>