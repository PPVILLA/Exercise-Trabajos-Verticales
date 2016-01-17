<main class="container">
  <!-- echo out the system feedback (error and success messages) -->
  <?php $this->renderFeedbackMessages(); ?>

  <div class="row">
    <h2 class="center">Establecer nueva contraseña</h2>

    <!-- new password form box -->
    <form class="col s12" method="post" action="<?php echo Config::get('URL'); ?>user/changePassword_action" name="new_password_form">
      <div class="row">
        <div class="input-field col s12 m6 offset-m3">
          <input type="password" id="change_input_password_current" class="validate" name="change_input_password_current" pattern=".{6,}" placeholder="Contraseña (6+ caracteres)" required autocomplete="off" >
          <label class="col s12 no-padding" for="change_input_password_current" data-error="Tiene que tener más de 6 caracteres" data-success="correcto">Introduce la contraseña actual:</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m6 offset-m3">
          <input type="password" id="change_input_password_new" class="validate" name="user_password_new" pattern=".{6,}" placeholder="Contraseña (6+ caracteres)" required autocomplete="off" >
          <label class="col s12 no-padding" for="user_password_new" data-error="Tiene que tener más de 6 caracteres" data-success="correcto">Nueva contraseña (min. 6 caracteres)</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m6 offset-m3">
          <input type="password" id="change_input_password_repeat" class="validate" name="user_password_repeat" pattern=".{6,}" required placeholder="Repite tu contraseña" autocomplete="off" >
          <label class="col s12 no-padding" for="user_password_repeat" data-error="Tiene que tener más de 6 caracteres" data-success="correcto">Repita contraseña</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 center">
          <button name="submit_new_password" class="btn waves-effect waves-light center" type="submit">Enviar nueva contraseña
            <i class="material-icons right">send</i>
          </button>
        </div>
      </div>
    </form>
  </div>
</main>
