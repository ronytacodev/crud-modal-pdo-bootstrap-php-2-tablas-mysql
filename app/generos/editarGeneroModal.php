<!-- Modal -->
<div class="modal fade" id="edit_Genero_<?php echo $genero->id; ?>" tabindex="-1" aria-labelledby="editGeneroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editGeneroModalLabel">Editar género</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../app/generos/actualizaGenero.php?id=<?php echo $genero->id; ?>" method="POST">
                    <div class="mb-3">
                        <label for="genero" class="form-label">Nombre:</label>
                        <input type="text" name="genero" id="genero" class="form-control" value="<?php echo $genero->nombre; ?>" required>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>