<?php
session_start();

require "../config/database.php";
$sqlPeliculas = $conn->query("SELECT p.id, p.nombre, p.descripcion, g.nombre AS genero FROM pelicula AS p INNER JOIN genero AS g ON p.id_genero = g.id");
$peliculas = $sqlPeliculas->fetchAll(PDO::FETCH_OBJ);

$dir = "posters/";
// print_r($peliculas);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD modal-ajax-php-mysql</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- cdn fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="container py-3">
        <h2 class="text-center">Peliculas</h2>

        <hr>

        <div class="row justify-content-end">
            <div class="col-auto mb-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal">
                    <i class="fa-solid fa-plus"></i> Nuevo Registro
                </button>
            </div>
        </div>

        <!-- inicio alerta -->
        <?php if (isset($_SESSION['msg']) && isset($_SESSION['color'])) { ?>
            <div class="alert alert-<?= $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['msg']);
            unset($_SESSION['color']);
        } ?>
        <!-- fin alerta -->

        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Género</th>
                    <th>Póster</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peliculas as $pelicula) { ?>

                    <tr>
                        <th><?php echo $pelicula->id; ?></th>
                        <td><?php echo $pelicula->nombre; ?></td>
                        <td><?php echo $pelicula->descripcion; ?></td>
                        <td><?php echo $pelicula->genero; ?></td>
                        <td><img src="<?= $dir . $pelicula->id . '.jpg?n=' . time(); ?>" width="100"></td>
                        <td>
                            <a href="#edit_<?php echo $pelicula->id; ?>" class="btn btn-sm btn-warning" data-bs-toggle="modal"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>

                        <td>
                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal" data-bs-id="<?php echo $pelicula->id; ?>"><i class="fa-solid fa-trash"></i></a>
                        </td>
                        <?php include "editarModal.php"; ?>
                    </tr>

                <?php } ?>

            </tbody>
        </table>
    </div>

    <?php
    $sqlGenero = $conn->query("SELECT id, nombre FROM genero");
    $generos = $sqlGenero->fetchAll(PDO::FETCH_OBJ);
    ?>

    <?php include "nuevoModal.php"; ?>
    <?php include "eliminarModal.php"; ?>

    <script>
        let eliminarModal = document.getElementById('eliminarModal');

        eliminarModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-bs-id');
            eliminarModal.querySelector('.modal-footer #id').value = id;
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>