<div class="container">

  <!-- echo out the system feedback (error and success messages) -->
  <?php $this->renderFeedbackMessages(); ?>

  <!-- login box -->
  <div class="row">
    <!-- register form -->
    <form class="col s12" method="post" action="<?php echo Config::get('URL'); ?>login/register_action">
      <h2 class="center">Registra una nueva cuenta</h2>
      <!-- the user name input field uses a HTML5 pattern check -->
      <div class="row">
        <div class="input-field col s12 m6">
        <input type="text" class="validate" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="Nombre Usuario (letras/numeros, 2-64 caracteres)" required autofocus>
          <label class="col s12 no-padding" for="user_name" data-error="incorrecto" data-success="correcto">Nick</label>
        </div>
        <div class="input-field col s12 m6">
          <input type="email" class="validate" name="user_email" placeholder="Dirección email (una dirección real)" required >
          <label class="col s12 no-padding" for="user_email" data-error="No se ajusta al patrón de un email" data-success="correcto">Direccion email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m6">
          <input type="password" class="validate" name="user_password_new" pattern=".{6,}" placeholder="Contraseña (6+ caracteres)" required autocomplete="off" >
          <label class="col s12 no-padding" for="user_password_new" data-error="Tiene que tener más de 6 caracteres" data-success="correcto">contraseña</label>
        </div>
        <div class="input-field col s12 m6">
          <input type="password" class="validate" name="user_password_repeat" pattern=".{6,}" required placeholder="Repite tu contraseña" autocomplete="off" >
          <label class="col s12 no-padding" for="user_password_repeat" data-error="Tiene que tener más de 6 caracteres" data-success="correcto">Repite contraseña</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m4">
          <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="name" placeholder="Nombre (letras 2-64 caracteres)" required >
          <label class="col s12 no-padding" for="name" data-error="Introduzca letras (entre 2 y 64 caracteres)" data-success="correcto">Nombre</label>
        </div>
        <div class="input-field col s12 m4">
          <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="user_surname1" placeholder="Primer Apellido (letras 2-64 caracteres)" required >
          <label class="col s12 no-padding" for="user_surname1" data-error="Introduzca letras (entre 2 y 64 caracteres)" data-success="correcto">Primer Apellido</label>
        </div>
        <div class="input-field col s12 m4">
          <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="user_surname2" placeholder="Segundo Apellido (letras 2-64 caracteres)" required >
          <label class="col s12 no-padding" for="user_surname2" data-error="Introduzca letras (entre 2 y 64 caracteres)" data-success="correcto">Segundo Apellido</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="text" class="validate" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s,]{2,64}" name="user_address" placeholder="Domicilio (letras/numeros, 2-64 caracteres)" required >
          <label class="col s12 no-padding" for="user_address" data-error="Introduzca letras (entre 2 y 64 caracteres)" data-success="correcto">Domicilio</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m6">
          <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="user_city" placeholder="Poblacion (letras 2-64 caracteres)" required >
          <label class="col s12 no-padding" for="user_city" data-error="Introduzca letras (entre 2 y 64 caracteres)" data-success="correcto">Poblacion</label>
        </div>
        <div class="input-field col s12 m6">
          <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="user_province" placeholder="Provincia (letras 2-64 caracteres)" required >
          <label class="col s12 no-padding" for="user_province" data-error="Introduzca letras (entre 2 y 64 caracteres)" data-success="correcto">Provincia</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m6">
          <input type="text" class="validate" pattern="^([0-9]{8,8})([A-Z])$" name="user_NIF" placeholder="NIF (12345678X)" required >
          <label class="col s12 no-padding" for="user_NIF" data-error="Introduzca 8 digitos y una letra en mayuscula" data-success="correcto">NIF</label>
        </div>
        <div class="input-field col s12 m6">
          <input type="text" class="validate" pattern="^(\+34\s?)([9|6][0-9]{8})$|^([9|6][0-9]{8})$" name="user_phone" placeholder="Telefono de contacto (+34923456789 +34 923456789 923456789 +34 623456789 623456789)" required >
          <label class="col s12 no-padding" for="user_phone" data-error="incorrecto" data-success="correcto">Telefono</label>
        </div>
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
          <button class="btn waves-effect waves-light center" type="submit">Registrarse
            <i class="material-icons right">send</i>
          </button>
        </div>
      </div>
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
