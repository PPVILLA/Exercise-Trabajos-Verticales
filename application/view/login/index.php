<div class="container">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <form class="form-signin" action="<?php echo Config::get('URL'); ?>login/login" method="post">
        <h2 class="form-signin-heading">Logueate aquí</h2>
        <label for="email" class="sr-only">Email</label>
        <input type="text" class="form-control" name="user_name" placeholder="Nombre de Usuario o Direccion email" required autofocus>
        <label for="password" class="sr-only">Contraseña</label>
        <input type="password" class="form-control" name="user_password" placeholder="Contraseña" required>
        <div class="checkbox">
          <label for="set_remember_me_cookie">
            <input type="checkbox" name="set_remember_me_cookie" value="recordarme">
            Recuérdame durante 2 semanas
          </label>
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
        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Acceder">

        <a href="<?php echo Config::get('URL'); ?>login/requestPasswordReset" class="form-control">Olvidé mi contraseña</a>

        <h3>No tienes cuenta todavía?</h3>
        <a href="<?php echo Config::get('URL'); ?>login/register" class="form-control">Regístrate</a>
    </form>
</div>
