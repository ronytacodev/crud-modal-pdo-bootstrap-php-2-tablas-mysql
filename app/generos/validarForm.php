<?php
session_start();

// verificamos que solo se ingresen letras en Nombres.
$patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";

if (!preg_match($patron_texto, trim($_POST['genero']))) {
    $_SESSION['color'] = "warning";
    $_SESSION['msg'] = "<strong>Error!</strong> Solo se aceptan letras en el campo Género.";
    header('Location: ../peliculas/index.php');
    exit();
}
