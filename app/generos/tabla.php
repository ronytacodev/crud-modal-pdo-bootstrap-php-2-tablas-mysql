<?php

require "../config/database.php";
$sqlGeneros = $conn->query("SELECT id, nombre FROM genero");
$listaGeneros = $sqlGeneros->fetchAll(PDO::FETCH_OBJ);

?>

<div class="col-md-3">
    <table class="table table-sm table-striped table-hover mt-4">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Género</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaGeneros as $genero) { ?>
                <tr>
                    <th><?php echo $genero->id; ?></th>
                    <td><?php echo $genero->nombre; ?></td>
                    <td>
                        <a href="#edit_Genero_<?php echo $genero->id; ?>" class="btn btn-sm btn-warning" data-bs-toggle="modal"><i class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                    <td>
                        <a href="#delete_Genero_<?php echo $genero->id; ?>" class="btn btn-sm btn-danger" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i></a>
                    </td>
                    <?php include "editarGeneroModal.php"; ?>
                    <?php include "eliminarGeneroModal.php"; ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include "addGeneroModal.php"; ?>