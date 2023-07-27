<?php
session_start();

if (empty($_GET["id"])) {
    $_SESSION["color"] = "warning";
    $_SESSION["msg"] = "Completa el campo.";
    header('Location: ../peliculas/index.php');
    exit();
}

require "../config/database.php";

$id = $_GET["id"];

$sentencia = $conn->prepare("DELETE FROM genero where id = ?;");
$resultado = $sentencia->execute([$id]);

if ($resultado === TRUE) {
    $_SESSION["color"] = "success";
    $_SESSION["msg"] = "Registro eliminado";
    header('Location: ../peliculas/index.php');
} else {
    $_SESSION["color"] = "danger";
    $_SESSION["msg"] = "Error al intentar eliminar registro";
    header('Location: ../peliculas/index.php');
    exit();
}
