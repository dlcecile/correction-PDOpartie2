<?php
define('USER', 'phpmyadmin');
define('PASSWD', '4CB10.1QSs');
define('HOST', 'localhost');
define('DB', 'hospitalE2N');

function connectDb() {
    require_once 'params.php';

    $dsn = 'mysql:dbname=' . DB . ';host=' . HOST;
    try {
        $db = new PDO($dsn, USER, PASSWD, ['PDO::ATTR_ERRMODE'=> 'PDO::ERRMODE_EXCEPTION']);
        return $db;
    } catch (Exception $ex) {
        die('La connexion à la bdd a échoué !');
    }
}
?>