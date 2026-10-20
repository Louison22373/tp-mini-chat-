<?php

session_start();

require_once('connexion.php');

$username = $_POST['username'];
$password = $_POST['password'];


$request = $db->prepare(
    'SELECT * FROM users WHERE username = ?'
);

$request->execute([$username]);

$user = $request->fetch();


if ($user && password_verify($password, $user['password'])) {

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    header('Location: index.php');
    exit;

}


echo 'Pseudo ou mot de passe incorrect.';

?>
