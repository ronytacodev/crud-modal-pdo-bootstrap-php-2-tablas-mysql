<?php
session_start();

// verificamos que no esten vacíos los campos del formulario.
if (empty($_GET["id"]) || empty($_POST["nombre"]) || empty($_POST["descripcion"]) || empty($_POST["genero"])) {
    $_SESSION["color"] = "warning";
    $_SESSION["msg"] = "Rellena todos los campos";
    header('Location: index.php');
    exit();
}

require "../config/database.php";

$id = $_GET["id"];
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$genero = $_POST["genero"];

$sql = $conn->prepare("UPDATE pelicula SET nombre = ?, descripcion = ?, id_genero = ? where id = ?;");
$resultado = $sql->execute([$nombre, $descripcion, $genero, $id]);

if ($resultado === TRUE) {
    $_SESSION["color"] = "success";
    $_SESSION["msg"] = "Registro actualizado.";

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
            $_SESSION['color'] = "danger";
            $_SESSION['msg'] .= "<br>Formato de imagen no permitido";
        }
    }
} else {
    $_SESSION["color"] = "danger";
    $_SESSION["msg"] = "Error al intentar actualizar registro";
}

header('Location: index.php');
exit();
