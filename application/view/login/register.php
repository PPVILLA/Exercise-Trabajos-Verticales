<div class="container">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <!-- login box -->
    <div class="container" style="width: 50%; display: block;">
        <!-- register form -->
        <form class="form-signin" method="post" action="<?php echo Config::get('URL'); ?>login/register_action">
            <h2 class="form-signin-heading">Registra una nueva cuenta</h2>
            <!-- the user name input field uses a HTML5 pattern check -->
            <input type="text" class="form-control" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="Nombre Usuario (letras/numeros, 2-64 caracteres)" required />
            <input type="text" class="form-control" name="user_email" placeholder="Dirección email (una dirección real)" required />
            <input type="password" class="form-control" name="user_password_new" pattern=".{6,}" placeholder="Contraseña (6+ caracteres)" required autocomplete="off" />
            <input type="password" class="form-control" name="user_password_repeat" pattern=".{6,}" required placeholder="Repite tu contraseña" autocomplete="off" />

            <!-- show the captcha by calling the login/showCaptcha-method in the src attribute of the img tag -->
            <img id="captcha" src="<?php echo Config::get('URL'); ?>login/showCaptcha" />
            <input type="text" class="form-control" name="captcha" placeholder="Please enter above characters" required />

            <!-- quick & dirty captcha reloader -->
            <a href="#" style="display: block; font-size: 11px; margin: 5px 0 15px 0; text-align: center"
               onclick="document.getElementById('captcha').src = '<?php echo Config::get('URL'); ?>login/showCaptcha?' + Math.random(); return false" class="form-control">Reload Captcha</a>

            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Registrarse" />
        </form>
    </div>
</div>
<!-- <div class="container">
    <p style="display: block; font-size: 11px; color: #999;">
        Please note: This captcha will be generated when the img tag requests the captcha-generation
        (= a real image) from YOURURL/login/showcaptcha. As this is a client-side triggered request, a
        $_SESSION["captcha"] dump will not show the captcha characters. The captcha generation
        happens AFTER the request that generates THIS page has been finished.
    </p>
</div> -->
