<main class="container">
    <h1>NoteController/index</h1>
    <div class="container">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3>¿Qué sucede aquí?</h3>
        <p>
            Esto es sólo una sencilla implmentación de un CRUD. Crear, leer, actualizar y eliminar cosas.
        </p>
        <p>
            <form method="post" action="<?php echo Config::get('URL');?>note/create">
                <label>Texto de nueva nota: </label><input type="text" name="note_text" />
                <input type="submit" value='Crear esta nota' autocomplete="off" />
            </form>
        </p>

        <?php if ($this->notes) { ?>
            <table class="responsive-table bordered striped centered">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Nota</td>
                    <td>EDITAR</td>
                    <td>ELIMINAR</td>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($this->notes as $key => $value) { ?>
                        <tr>
                            <td><?= $value->note_id; ?></td>
                            <td><?= htmlentities($value->note_text); ?></td>
                            <td><a href="<?= Config::get('URL') . 'note/edit/' . $value->note_id; ?>">Editar</a></td>
                            <td><a href="<?= Config::get('URL') . 'note/delete/' . $value->note_id; ?>">Eliminar</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <div>No hay notas aún. Crear algunas!</div>
            <?php } ?>
    </div>
</main>
