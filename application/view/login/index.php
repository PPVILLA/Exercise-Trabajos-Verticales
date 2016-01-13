<main class="container">
  <!-- echo out the system feedback (error and success messages) -->
  <?php $this->renderFeedbackMessages(); ?>

  <!-- login box -->
  <div class="row">

    <form class="col s12" action="<?php echo Config::get('URL'); ?>login/login" method="post">
      <h2 class="center">Loguéate</h2>
      <div class="row">
        <div class="input-field col s12 m6 offset-m3">
          <input type="text" class="validate" pattern=".{2,64}" name="user_name" placeholder="Nombre de Usuario o Direccion email" required autofocus>
          <label for="user_name" class="col s12 no-padding" data-error="Introduzca letras (entre 2 y 64 caracteres)" data-success="correcto">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m6 offset-m3">
          <input type="password" class="validate" pattern=".{6,}" name="user_password" placeholder="Introduzca su contraseña" required>
          <label for="user_password" class="col s12 no-padding" data-error="Tiene que tener más de 6 caracteres" data-success="correcto">Contraseña</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m6 offset-m3">
          <input type="checkbox" id="test9" name="set_remember_me_cookie">
          <label for="text9">Recuérdame durante 2 semanas</label>
        </div>
      </div>
      <!-- when a user navigates to a page that's only accessible for logged a logged-in user, then
           the user is sent to this page here, also having the page he/she came from in the URL parameter
           (have a look). This "where did you came from" value is put into this form to sent the user back
           there after being logged in successfully.
           Simple but powerful feature, big thanks to @tysonlist. -->
           <?php if (!empty($this->redirect)) { ?>
           <input type="hidden" name="redirect" value="<?php echo $this->redirect ?>">
           <?php } ?>
      <!--
  		set CSRF token in login form, although sending fake login requests mightn't be interesting gap here.
  		If you want to get deeper, check these answers:
  			1. natevw's http://stackoverflow.com/questions/6412813/do-login-forms-need-tokens-against-csrf-attacks?rq=1
  			2. http://stackoverflow.com/questions/15602473/is-csrf-protection-necessary-on-a-sign-up-form?lq=1
  			3. http://stackoverflow.com/questions/13667437/how-to-add-csrf-token-to-login-form?lq=1
      -->
      <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
      <div class="row">
        <div class="input-field col s12 center">
          <button class="btn waves-effect waves-light center" type="submit">Acceder
            <i class="material-icons right">send</i>
          </button>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 center">
          <a href="<?php echo Config::get('URL'); ?>login/requestPasswordReset" class="col s12 m6 offset-m3">Olvidé mi contraseña</a>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 center">
          <h4>No tienes cuenta todavía?</h4>
          <a href="<?php echo Config::get('URL'); ?>login/register" class="col s12 m6 offset-m3">Regístrate</a>
        </div>
      </div>
   </form>
  </div>
</main>
