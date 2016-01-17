<main class="container">
  <!-- echo out the system feedback (error and success messages) -->
  <?php $this->renderFeedbackMessages(); ?>

  <div class="row">
    <h2 class="center">Cambia tu dirección email</h2>

    <form class="col s12" action="<?php echo Config::get('URL'); ?>user/editUserEmail_action" method="post">
      <div class="row">
        <div class="input-field col s12 m6 offset-m3">
          <input type="email" class="validate" name="user_email" placeholder="Dirección email (una dirección real)" required autofocus >
          <label class="col s12 no-padding" for="user_email" data-error="No se ajusta al patrón de un email">Nueva direccion email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 center">
          <button class="btn waves-effect waves-light center" type="submit">Enviar
            <i class="material-icons right">send</i>
          </button>
        </div>
      </div>
    </form>
  </div>
</main>
