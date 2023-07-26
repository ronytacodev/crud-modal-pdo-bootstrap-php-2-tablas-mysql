<?php
session_start();
require "../config/database.php";

$id = $_POST['id'];

$sentencia = $conn->prepare("DELETE FROM pelicula where id = ?;");
$resultado = $sentencia->execute([$id]);

if ($resultado === TRUE) {
    $_SESSION["color"] = "success";
    $_SESSION["msg"] = "Registro eliminado";
    header('Location: index.php');
} else {
    header('Location: index.php?mensaje=error');
    $_SESSION["color"] = "danger";
    $_SESSION["msg"] = "Error al intentar eliminar registro";
    header('Location: index.php');
    exit();
}
