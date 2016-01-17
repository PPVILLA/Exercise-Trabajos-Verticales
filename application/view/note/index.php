<main class="container">
    <div class="row">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <section class="col s12 center" >
            <h1>Tus notas</h1>
            <p>
                Esto es sólo una sencilla implementación de un CRUD. Crear, leer, actualizar y eliminar cosas.
            </p>
            <form method="post" action="<?php echo Config::get('URL');?>note/create">
                <div class="row">
                  <div class="input-field col s12 m6 offset-m3">
                    <label>Introduce texto de nueva nota: </label>
                    <input type="text" name="note_text" />
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6 offset-m3">
                    <button class="btn waves-effect waves-light center" type="submit" autocomplete="off">Crear esta nota
                      <i class="material-icons right">add</i>
                    </button>
                  </div>
                </div>
            </form>
        </section>
    </div>

    <div class="row">
        <section class="col s12 center" >
        <?php if ($this->notes) { ?>
            <table class="responsive-table bordered striped centered">
                <thead>
                <tr>
                    <td class="center">Id</td>
                    <td class="center">Nota</td>
                    <td class="center">EDITAR</td>
                    <td class="center">ELIMINAR</td>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($this->notes as $key => $value) { ?>
                        <tr>
                            <td><?= $value->note_id; ?></td>
                            <td><?= htmlentities($value->note_text); ?></td>
                            <td><a class="btn-floating btn-large" href="<?= Config::get('URL') . 'note/edit/' . $value->note_id; ?>"><i class="large material-icons">mode_edit</i></a></td>
                            <td><a class="btn-floating btn-large" href="<?= Config::get('URL') . 'note/delete/' . $value->note_id; ?>"><i class="large material-icons">clear</i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <div>No hay notas aún. Create algunas!</div>
            <?php } ?>
        </section>
    </div>
</main>
