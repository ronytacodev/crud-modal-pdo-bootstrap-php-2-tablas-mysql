<?php
// verificamos que solo se ingresen letras en Nombres.
$patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";

if (!preg_match($patron_texto, trim($_POST['nombre']))) {
    $_SESSION['color'] = "warning";
    $_SESSION['msg'] = "<strong>Error!</strong> Solo se aceptan letras en el campo Nombre.";
    header('Location: index.php');
    exit();
}
