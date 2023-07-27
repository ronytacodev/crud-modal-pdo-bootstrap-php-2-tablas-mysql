<?php
session_start();

// verificamos que no esten vacíos los campos del formulario.
if (empty($_POST["genero"])) {
    $_SESSION["color"] = "warning";
    $_SESSION["msg"] = "Completa el campo.";
    header('Location: ../peliculas/index.php');
    exit();
}
// print_r($_POST);
include 'validarForm.php';

require "../config/database.php";

$id = $_GET["id"];
$nuevo_genero = $_POST["genero"];
// print_r($nuevo_genero . " ---- ");
// print_r($id);

$sql = $conn->prepare("UPDATE genero SET nombre = ? WHERE id = ?;");
$resultado = $sql->execute([$nuevo_genero, $id]);

if ($resultado === TRUE) {
    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Registro guardado";
} else {
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Error al agregar registro";
}

header('Location: ../peliculas/index.php');
