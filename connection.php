<?php

$dsn = 'mysql:dbname=banking;host=127.0.0.1';
$user = 'banking';
$password = 'banking123';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
