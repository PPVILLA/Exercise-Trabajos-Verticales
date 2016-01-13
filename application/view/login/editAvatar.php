<main class="container">
    <h1>Edita tu avatar</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="container">
        <h3>Sube un Avatar</h3>

        <div class="feedback info">
            Si sigue viendo la imagen anterior después de cargar uno nuevo: Actualiza la página con F5! Su navegador no se da cuenta de que hay una nueva imagen y que la antigua imagen tiene el mismo nombre de archivo.
        </div>

        <form action="<?php echo Config::get('URL'); ?>login/uploadAvatar_action" method="post" enctype="multipart/form-data">
            <label for="avatar_file">Seleccione una imagen de avatar de su disco duro (será reducida a 44x44 px, actualmente sólo .jpg):</label>
            <input type="file" name="avatar_file" required />
            <!-- max size 5 MB (as many people directly upload high res pictures from their digital cameras) -->
            <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
            <input type="submit" value="Cargar imagen" />
        </form>
    </div>

    <div class="box">
        <h3>Eliminar tu avatar</h3>
        <p>Haga clic en este enlace para eliminar tu avatar (local): <a href="<?php echo Config::get('URL'); ?>login/deleteAvatar_action">Eliminar tu avatar</a>
    </div>
</main>
