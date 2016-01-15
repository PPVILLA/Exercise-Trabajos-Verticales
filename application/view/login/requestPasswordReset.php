<main class="container">
    <h1>Solicite un restablecimiento de contraseña</h1>
    <div class="container">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
      <div class="row">
        <!-- request password reset form box -->
        <form class="col s12" method="post" action="<?php echo Config::get('URL'); ?>login/requestPasswordReset_action">
          <div class="row">
            <div class="input-field col s12 m6">
              <label for="user_name_or_email">
                  Introduzca su nombre de usuario o correo electrónico y recibirás un correo con instrucciones:
                  <input type="text" name="user_name_or_email" required />
              </label>
            </div>
            <div class="row">
              <div class="input-field col s12 center">
                <!-- show the captcha by calling the login/showCaptcha-method in the src attribute of the img tag -->
                <img id="captcha" src="<?php echo Config::get('URL'); ?>login/showCaptcha" >
                <input type="text" class="col s12 m6 offset-m3 validate" name="captcha" placeholder="Por favor, introduzca los caracteres anteriores" required >

                <!-- quick & dirty captcha reloader -->
                <a class="col s12 m6 offset-m3" href="#" onclick="document.getElementById('captcha').src = '<?php echo Config::get('URL'); ?>login/showCaptcha?' + Math.random(); return false">Recarga Captcha</a>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 center">
                <button class="btn waves-effect waves-light center" type="submit">Envíame un correo electrónico de restablecimiento de contraseña
                  <i class="material-icons right">send</i>
                </button>
              </div>
        </form>
      </div>
    </div>
</main>
