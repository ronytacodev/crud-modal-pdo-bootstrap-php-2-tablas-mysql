<?php
require "../config/database.php";

$id = 8;

// Buscando cuántos son los registros de películas que pertenezcan al id del género que se va a eliminar
$sentencia = $conn->prepare("SELECT COUNT(*) AS Registros, p.nombre FROM pelicula AS p INNER JOIN genero AS g ON p.id_genero = g.id WHERE id_genero = ?;");
$sentencia->execute([$id]);
$resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $row) {
    echo $row["Registros"];
}
