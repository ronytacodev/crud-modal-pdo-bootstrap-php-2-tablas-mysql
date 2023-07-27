<?php

session_start();

// verificamos que no esten vacíos los campos del formulario.
if (empty($_POST["nombre"]) || empty($_POST["descripcion"]) || empty($_POST["genero"])) {
    $_SESSION["color"] = "warning";
    $_SESSION["msg"] = "Rellena todos los campos";
    header('Location: index.php');
    exit();
}

require "../config/database.php";

$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$genero = $_POST["genero"];

$sql = $conn->prepare("INSERT INTO pelicula (nombre,descripcion, id_genero) VALUES (?,?,?)");
$resultado = $sql->execute([$nombre, $descripcion, $genero]);

if ($resultado === TRUE) {
    $id = $conn->lastInsertId();
    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Registro guardado";

    if ($_FILES['poster']['error'] == UPLOAD_ERR_OK) {
        $permitidos = array("image/jpg", "image/jpeg");
        if (in_array($_FILES['poster']['type'], $permitidos)) {
            $dir = "posters";
            $info_img = pathinfo($_FILES['poster']['name']);
            $info_img['extension'];

            $poster = $dir . '/' . $id . '.jpg';

            if (!file_exists($dir)) {
                mkdir($dir, 0777);
            }

            if (!move_uploaded_file($_FILES['poster']['tmp_name'], $poster)) {
                $_SESSION['color'] = "danger";
                $_SESSION['msg'] .= "<br>Error al guardar imagen";
            }
        } else {
            $_SESSION['msg'] .= "<br>Formato de imagen no permitido";
        }
    }
} else {
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Error al agregar registro";
}

header('Location: index.php');
