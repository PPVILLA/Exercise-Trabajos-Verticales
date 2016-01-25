<main class="row" style="margin: 0 5%;">
  <h1 class="center">Panel de gestion de empleados</h1>

  <!-- echo out the system feedback (error and success messages) -->
  <?php $this->renderFeedbackMessages(); ?>
  <div class="row">
    <!-- register form -->
    <form class="col s12" method="post" action="<?php echo Config::get('URL'); ?>register/register_employee_action">
      <h2 class="center">Registra una nueva cuenta de empleado</h2>
      <!-- the user name input field uses a HTML5 pattern check -->
      <div class="row">
        <div class="input-field col s12 m4">
          <input type="text" class="validate" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="Nombre Usuario (letras/numeros, 2-64 caracteres)" required autofocus>
          <label class="col s12 no-padding" for="user_name" data-error="incorrecto" >Nick</label>
        </div>
        <div class="input-field col s12 m4">
          <input type="email" class="validate" name="user_email" placeholder="Dirección email (una dirección real)" required >
          <label class="col s12 no-padding" for="user_email" data-error="No se ajusta al patrón de un email" >Direccion email</label>
        </div>
        <div class="input-field col s12 m4">
          <input type="email" class="validate" name="user_email_repeat" placeholder="Repita la dirección email (para evitar errores tipográficos)" required >
          <label class="col s12 no-padding" for="user_email_repeat" data-error="No se ajusta al patrón de un email" >Repita direccion email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m6">
          <input type="password" class="validate" name="user_password_new" pattern=".{6,}" placeholder="Contraseña (6+ caracteres)" required autocomplete="off" >
          <label class="col s12 no-padding" for="user_password_new" data-error="Tiene que tener más de 6 caracteres" >contraseña</label>
        </div>
        <div class="input-field col s12 m6">
          <input type="password" class="validate" name="user_password_repeat" pattern=".{6,}" required placeholder="Repite tu contraseña" autocomplete="off" >
          <label class="col s12 no-padding" for="user_password_repeat" data-error="Tiene que tener más de 6 caracteres" >Repita contraseña</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m4">
          <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\.\s-]{2,64}" name="name" placeholder="Nombre (letras 2-64 caracteres)" required >
          <label class="col s12 no-padding" for="name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Nombre</label>
        </div>
        <div class="input-field col s12 m4">
          <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\.\s-]{2,64}" name="user_surname1" placeholder="Primer Apellido (letras 2-64 caracteres)" required >
          <label class="col s12 no-padding" for="user_surname1" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Primer Apellido</label>
        </div>
        <div class="input-field col s12 m4">
          <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\.\s-]{2,64}" name="user_surname2" placeholder="Segundo Apellido (letras 2-64 caracteres)" required >
          <label class="col s12 no-padding" for="user_surname2" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Segundo Apellido</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="text" class="validate" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\.\/\s,-]{2,64}" name="user_address" placeholder="Domicilio (letras/numeros, 2-64 caracteres)" required >
          <label class="col s12 no-padding" for="user_address" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Domicilio</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m6">
          <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\.\/\s,-]{2,64}" name="user_province" placeholder="Provincia (letras 2-64 caracteres)" required >
          <label class="col s12 no-padding" for="user_province" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Provincia</label>
        </div>
        <div class="input-field col s12 m6">
          <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\.\/\s,-]{2,64}" name="user_city" placeholder="Poblacion (letras 2-64 caracteres)" required >
          <label class="col s12 no-padding" for="user_city" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Poblacion</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m4">
          <input type="text" class="validate" pattern="^([0-9]{8,8})([A-Z])$" name="user_NIF" placeholder="NIF (12345678X)" required >
          <label class="col s12 no-padding" for="user_NIF" data-error="Introduzca 8 digitos y una letra en mayuscula" >NIF</label>
        </div>
        <div class="input-field col s12 m4">
          <input type="text" class="validate" pattern="^([9|6][0-9]{8})$" name="user_phone" placeholder="Telefono de contacto (+34923456789 +34 923456789 923456789 +34 623456789 623456789)" required >
          <label class="col s12 no-padding" for="user_phone" data-error="el nº telefono debe de empezar por 9 o por 6 hasta alcanzar 9 digitos." >Telefono</label>
        </div>
        <div class="input-field col s12 m4">
          <input type="text" class="validate" pattern="(\d{4})(-)([0][1-9]|[1][0-2])\2([0][1-9]|[12][0-9]|3[01])" name="user_contract_date" value="<?= date("Y-m-d"); ?>" required >
          <label class="col s12 no-padding" for="user_contract_date" data-error="Introduzca una fecha con formato AAAA-MM-DD" >Fecha contratación</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 center">
          <!-- show the captcha by calling the login/showCaptcha-method in the src attribute of the img tag -->
          <img id="captcha" src="<?php echo Config::get('URL'); ?>register/showCaptcha" >
          <input type="text" class="col s12 m6 offset-m3 validate" name="captcha" placeholder="Por favor, introduzca los caracteres anteriores" required >

          <!-- quick & dirty captcha reloader -->
          <a class="col s12 m6 offset-m3" href="#" onclick="document.getElementById('captcha').src = '<?php echo Config::get('URL'); ?>login/showCaptcha?' + Math.random(); return false">Recarga Captcha</a>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 center">
          <button class="btn waves-effect waves-light center" type="submit">Añadir empleado
            <i class="material-icons right">add</i>
          </button>
        </div>
      </div>
    </form>
  </div>
    <div class="row">
        <div class="col s12">
        <?php if ($this->users) { ?>
            <table class="responsive-table bordered striped centered">
                <thead>
                  <tr>
                      <th>Id</th>
                      <th>Avatar</th>
                      <th>Nick</th>
                      <th>email de usuarios</th>
                      <th>tipo de cuenta</th>
                      <th>Fecha contratacion</th>
                      <th>¿Activado?</th>
                      <th>Intentos fallidos de Login</th>
                      <th>Link al perfil de usuario</th>
                      <th>Dias de suspensión</th>
                      <th>Borrado logico</th>
                      <th>¿Resetear intentos de Login y activar usuario?</th>
                      <th>Enviar</th>
                      <th>Editar</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i = 0 ?>
                <?php foreach ($this->users as $user) { $i++; ?>
                    <tr class="<?= ($user->user_active == 0 ? 'inactive' : 'active'); ?>">
                        <td><?= $user->user_id; ?></td>
                        <td class="avatar">
                            <?php if (isset($user->user_avatar_link)) { ?>
                                <img src="<?= $user->user_avatar_link; ?>"/>
                            <?php } ?>
                        </td>
                        <td><?= $user->user_name; ?></td>
                        <td><?= $user->user_email; ?></td>
                        <td><?php if ($user->user_account_type == 7) : ?> Administrador <?php elseif($user->user_account_type == 4) : ?> Empleado <?php else: ?> Normal <?php endif ?></td>
                        <td><?= $user->user_contract_date; ?></td>
                        <td><?= ($user->user_active == 0 ? 'No' : 'Si'); ?></td>
                        <td><?= $user->user_failed_logins; ?></td>
                        <td>
                            <a href="<?= Config::get('URL') . 'profile/showProfile/' . $user->user_id; ?>">Perfil</a>
                        </td>
                        <form action="<?= config::get("URL"); ?>employee/actionAccountSettings" method="post">
                            <td class="input-field"><input type="number" name="suspension" /></td>
                            <td>
                              <input type="checkbox" id="softDelete<?= $i ?>" name="softDelete" <?php if ($user->user_deleted) { ?> checked <?php } ?> />
                              <label for="softDelete<?= $i ?>"></label>
                            </td>
                            <td>
                              <input type="checkbox" id="resetUser<?= $i ?>" name="resetUser" />
                              <label for="resetUser<?= $i ?>"></label>
                            </td>
                            <td>
                                <input type="hidden" name="user_id" value="<?= $user->user_id; ?>" />
                                <button class="btn-floating btn-large" type="submit">
                                  <i class="material-icons right">send</i>
                                </button>
                            </td>
                        </form>
                        <td><a class="btn-floating btn-large" href="<?= Config::get('URL') . 'user/editPrivateData/' . $user->user_name; ?>"><i class="large material-icons">mode_edit</i></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div>No hay ningún empleado aún. Créate alguno!</div>
        <?php } ?>
        </div>
    </div>
</main>
