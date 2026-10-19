<?php

try {

    $dsn = 'mysql:host=localhost;dbname=minichat;charset=utf8';

    $user = 'root';

    $password = '';

    $db = new PDO($dsn, $user, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $message) {

    echo 'Database connection error: <br>';
    echo '<pre>' . $message . '</pre>';

}

?>