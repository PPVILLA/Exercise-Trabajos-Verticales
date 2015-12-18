<div class="container">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <!-- login box -->
    <div class="container" style="width: 50%; display: block;">
        <!-- register form -->
        <form class="form-horizontal" method="post" action="<?php echo Config::get('URL'); ?>login/register_action">
            <h2 class="text-center">Registra una nueva cuenta</h2>
            <!-- the user name input field uses a HTML5 pattern check -->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="user_name">Nick</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="Nombre Usuario (letras/numeros, 2-64 caracteres)" required />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="user_email">Direccion email</label>
              <div class="col-sm-8">
                <input type="email" class="form-control" name="user_email" placeholder="Dirección email (una dirección real)" required />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="user_password_new">contraseña</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" name="user_password_new" pattern=".{6,}" placeholder="Contraseña (6+ caracteres)" required autocomplete="off" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="user_password_repeat">Repite contraseña</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" name="user_password_repeat" pattern=".{6,}" required placeholder="Repite tu contraseña" autocomplete="off" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="name">Nombre</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="name" placeholder="Nombre (letras 2-64 caracteres)" required />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="user_surname1">Primer Apellido</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="user_surname1" placeholder="Primer Apellido (letras 2-64 caracteres)" required />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="user_surname2">Segundo Apellido</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="user_surname2" placeholder="Segundo Apellido (letras 2-64 caracteres)" required />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="user_address">Domicilio</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s,]{2,64}" name="user_address" placeholder="Domicilio (letras/numeros, 2-64 caracteres)" required />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="user_city">Poblacion</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="user_city" placeholder="Poblacion (letras 2-64 caracteres)" required />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="user_province">Provincia</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="user_province" placeholder="Provincia (letras 2-64 caracteres)" required />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="user_NIF">NIF</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" pattern="^([0-9]{8,8})([A-Z])$" name="user_NIF" placeholder="NIF (12345678X)" required />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="user_phone">Telefono</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" pattern="^(\+34\s?)([9|6][0-9]{8})$|^([9|6][0-9]{8})$" name="user_phone" placeholder="Telefono de contacto (+34923456789 +34 923456789 923456789 +34 623456789 623456789)" required />
              </div>
            </div>

            <!-- show the captcha by calling the login/showCaptcha-method in the src attribute of the img tag -->
            <img id="captcha" src="<?php echo Config::get('URL'); ?>login/showCaptcha" />
            <input type="text" class="form-control" name="captcha" placeholder="Please enter above characters" required />

            <!-- quick & dirty captcha reloader -->
            <a href="#" style="display: block; font-size: 11px; margin: 5px 0 15px 0; text-align: center"
               onclick="document.getElementById('captcha').src = '<?php echo Config::get('URL'); ?>login/showCaptcha?' + Math.random(); return false" class="form-control">Recarga Captcha</a>

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
