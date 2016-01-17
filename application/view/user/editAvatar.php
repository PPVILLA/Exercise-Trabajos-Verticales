<main class="container">
  <!-- echo out the system feedback (error and success messages) -->
  <?php $this->renderFeedbackMessages(); ?>

  <h3 class="center">Suba un Avatar</h3>

  <div class="feedback info">
      Si sigue viendo la imagen anterior después de cargar uno nuevo: Actualiza la página con F5! Su navegador no se da cuenta de que hay una nueva imagen y que la antigua imagen tiene el mismo nombre de archivo.
  </div>

  <form action="<?php echo Config::get('URL'); ?>user/uploadAvatar_action" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="file-field input-field col s12">
        <div class="btn">
          <span>Seleccione una imagen de avatar de su disco duro (será reducida a 44x44 px, actualmente sólo .jpg):</span>
          <input type="file" name="avatar_file" required>
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12 center">
        <!-- max size 5 MB (as many people directly upload high res pictures from their digital cameras) -->
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
        <input class="btn waves-effect waves-light center" type="submit" value="Cargar imagen" />
      </div>
    </div>
  </form>
  <div class="row">
    <div class="col s12 center" >
        <h3>Eliminar tu avatar</h3>
        <h4>Haga clic en este enlace para eliminar tu avatar (local): </h4>
        <a class="btn waves-effect waves-light" href="<?php echo Config::get('URL'); ?>user/deleteAvatar_action">Eliminar tu avatar</a>
    </div>
  </div>
</main>
