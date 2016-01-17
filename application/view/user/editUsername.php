<main class="container">
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="row">
      <h2 class="center">Cambia tu nick (nombre de usuario)</h2>

      <form class="col s12" action="<?php echo Config::get('URL'); ?>user/editUserName_action" method="post">
        <div class="row">
          <div class="input-field col s12 m6 offset-m3">
            <input type="text" class="validate" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="Nuevo nombre usuario (letras/numeros, 2-64 caracteres)" required autofocus>
            <label class="col s12 no-padding" for="user_name" data-error="incorrecto">Nuevo nick (o nombre de usuario):</label>
          </div>
        </div>
  			<!-- set CSRF token at the end of the form -->
  			<input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>" />
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
