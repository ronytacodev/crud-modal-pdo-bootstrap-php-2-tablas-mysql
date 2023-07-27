<?php
require "../config/database.php";

$id = $genero->id;

// Buscando cuántos son los registros de películas que pertenezcan al id del género que se va a eliminar
$sentencia = $conn->prepare("SELECT COUNT(*) AS Registros, p.nombre FROM pelicula AS p INNER JOIN genero AS g ON p.id_genero = g.id WHERE id_genero = ?;");
$sentencia->execute([$id]);
$resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $row) { ?>




    <!-- Modal -->
    <div class="modal fade" id="delete_Genero_<?php echo $genero->id; ?>" tabindex=" -1" aria-labelledby="eliminarGeneroModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="eliminarGeneroModalLabel">Aviso</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Desea eliminar el registro?
                    <?php if ($row["Registros"] >= 2) {
                            echo '<div> Se encontraron ' . '"' . $row["Registros"] . '"' . ' películas que pertenecen al género que desea eliminar</div>';
                        } elseif ($row["Registros"] == 1) {
                            echo '<div> Se encontró ' . '"' . $row["Registros"] . '"' . ' película que pertenece al género que desea eliminar</div>';
                        } else {
                            echo '<div> Hay ' . '"' . $row["Registros"] . '"' . ' películas que pertenecen al género que desea eliminar</div>';
                        }

                        ?>
                </div>
            <?php
            }
            ?>

            <div class="modal-footer">
                <form action="../generos/eliminarGenero.php?id=<?php echo $genero->id; ?>" method="POST">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Eliminar</button>
                </form>
            </div>
            </div>
        </div>
    </div>