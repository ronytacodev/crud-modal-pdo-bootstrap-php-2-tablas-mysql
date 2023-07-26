<?php
$password = "";
$user = "root";
$db_name = "clone-crud-cinema";

try {
    $conn = new PDO(
        'mysql:host=localhost:33065;
        dbname=' . $db_name,
        $user,
        $password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
    // echo "Conexión ok";
} catch (Exception $e) {
    echo "Problema en la conexión: " . $e->getMessage();
}
