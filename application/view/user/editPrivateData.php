<main class="container">
    <div class="row">
        <h1 class="center">Edita datos de usuario</h1>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <section class="col s12" >
        <?php  if ($this->user) { ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>user/editSave">
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="hidden" name="user_id" value="<?php echo htmlentities($this->user->user_id); ?>" />
                    <input type="hidden" name="user_account_type" value="<?php echo htmlentities($this->user->user_account_type); ?>" />
                    <input type="text" class="validate" pattern="[a-zA-Z0-9]{2,64}" name="user_name" value="<?= $this->user->user_name; ?>" required>
                    <label class="col s12 no-padding" for="user_name" data-error="Introduzca letras y numeros sin espacios (entre 2 y 64 caracteres)" >Cambia Nick</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="email" class="validate" name="user_email" value="<?= $this->user->user_email; ?>" required >
                    <label class="col s12 no-padding" for="user_email" data-error="No se ajusta al patrón de un email" >Cambia direccion email</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="email" class="validate" name="user_email_repeat" value="<?= $this->user->user_email; ?>" required >
                    <label class="col s12 no-padding" for="user_email_repeat" data-error="No se ajusta al patrón de un email" >Repita direccion email</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6">
                    <input type="password" class="validate" name="user_password_new" pattern=".{6,}" value="" autocomplete="off" >
                    <label class="col s12 no-padding" for="user_password_new" data-error="Tiene que tener más de 6 caracteres" >Cambia contraseña</label>
                  </div>
                  <div class="input-field col s12 m6">
                    <input type="password" class="validate" name="user_password_repeat" pattern=".{6,}" value="" autocomplete="off" >
                    <label class="col s12 no-padding" for="user_password_repeat" data-error="Tiene que tener más de 6 caracteres" >Cambia Repita contraseña</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\.\s-]{2,64}" name="name" value="<?php echo htmlentities($this->user->name); ?>" required >
                    <label class="col s12 no-padding" for="name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia Nombre</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\.\s-]{2,64}" name="user_surname1" value="<?php echo htmlentities($this->user->user_surname1); ?>" required >
                    <label class="col s12 no-padding" for="user_surname1" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia Primer Apellido</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\.\s-]{2,64}" name="user_surname2" value="<?php echo htmlentities($this->user->user_surname2); ?>" required >
                    <label class="col s12 no-padding" for="user_surname2" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia Segundo Apellido</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input type="text" class="validate" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\.\/\s,-]{2,64}" name="user_address" value="<?php echo htmlentities($this->user->user_address); ?>" required >
                    <label class="col s12 no-padding" for="user_address" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia Domicilio</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col s12 m6">
                    <label for="provider_province" >Provincia</label>
                    <select class = "browser-default" id="provincia" name="provider_province" >
                      <option value="" >- Selecciona -</option>
                      <?php $provincias = UserModel::cargaProvincias();
                      foreach($provincias as $key => $value){
                        if($value->Codigo_provincia == $this->user->user_province){?>
                          <option value="<?=$value->Codigo_provincia; ?>" selected><?=$value->Nombre_provincia; ?></option>
                        <?php }else{?>
                          <option value="<?=$value->Codigo_provincia; ?>"><?=$value->Nombre_provincia; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col s12 m6">
                    <label for="provider_city_id">Poblacion</label>
                    <select class = "browser-default" name="provider_city_id" >
                      <?php $municipios = UserModel::cargaMunicipios($this->user->user_province);
                      foreach($municipios as $key => $value){
                        if($value->id_municipio == $this->user->user_city_id){?>
                          <option value="<?=$value->id_municipio; ?>" selected><?=$value->nombre; ?></option>
                        <?php }else{?>
                          <option value="<?=$value->id_municipio; ?>"><?=$value->nombre; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="^([0-9]{8,8})([A-Z])$" name="user_NIF" value="<?php echo htmlentities($this->user->user_NIF); ?>" required >
                    <label class="col s12 no-padding" for="user_NIF" data-error="Introduzca 8 digitos y una letra en mayuscula" >Cambia NIF</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="^([9|6][0-9]{8})$" name="user_phone" value="<?php echo htmlentities($this->user->user_phone); ?>" required >
                    <label class="col s12 no-padding" for="user_phone" data-error="el nº telefono debe de empezar por 9 o por 6 hasta alcanzar 9 digitos." >Cambia Telefono</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="(\d{4})(-)([0][1-9]|[1][0-2])\2([0][1-9]|[12][0-9]|3[01])" name="user_contract_date" value="<?= $this->user->user_contract_date ?>" required >
                    <label class="col s12 no-padding" for="user_contract_date" data-error="Introduzca una fecha con formato AAAA-MM-DD" >Fecha contratación</label>
                  </div
                </div>
                <div class="row">
                  <div class="input-field col s12 center">
                    <button class="btn waves-effect waves-light center" type="submit" autocomplete="off">Cambia
                      <i class="material-icons right">send</i>
                    </button>
                  </div>
                </div>
            </form>
        <?php } else { ?>
            <p>Este usuatio no existe.</p>
        <?php } ?>
    </div>
</main>
