<main class="container">
    <div class="row">
        <h1 class="center">Edita un local</h1>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <section class="col s12" >

        <?php if ($this->local) { ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>local/editSave">
                <div class="row">
                  <div class="input-field col s12 m6 offset-m3">
                    <input type="hidden" name="local_id" value="<?php echo htmlentities($this->local->local_id); ?>" />
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="local_name" value="<?php echo htmlentities($this->local->local_name); ?>" required >
                    <label class="col s12 no-padding" for="local_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia nombre del local</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s,]{2,64}" name="local_address" value="<?php echo htmlentities($this->local->local_address); ?>" required >
                    <label class="col s12 no-padding" for="local_address" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia domicilio</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[0-9A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="local_city_id" value="<?php echo htmlentities($this->local->local_city_id); ?>" required >
                    <label class="col s12 no-padding" for="local_city_id" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia poblacion</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="^(\+34\s?)([9|6][0-9]{8})$|^([9|6][0-9]{8})$" name="local_phone" value="<?php echo htmlentities($this->local->local_phone); ?>" required >
                    <label class="col s12 no-padding" for="local_phone" data-error="incorrecto" >Cambia telefono</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6">
                    <input type="email" class="validate" name="local_email" value="<?php echo htmlentities($this->local->local_email); ?>" required >
                    <label class="col s12 no-padding" for="local_email" data-error="No se ajusta al patrón de un email" >Cambia direccion email</label>
                  </div>
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="local_contact_name" value="<?php echo htmlentities($this->local->local_contact_name); ?>" required >
                    <label class="col s12 no-padding" for="local_contact_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia nombre de persona de contacto</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="local_latitud" value="<?php echo htmlentities($this->local->local_latitud); ?>" required >
                    <label class="col s12 no-padding" for="local_latitud" data-error="incorrecto: numeros decimales (use una coma)" >Cambia latitud</label>
                  </div>
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="local_longitud" value="<?php echo htmlentities($this->local->local_longitud); ?>" required >
                    <label class="col s12 no-padding" for="local_longitud" data-error="incorrecto: numeros decimales (use una coma)" >Cambia longitud</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <button class="btn waves-effect waves-light center" type="submit" autocomplete="off">Cambia
                      <i class="material-icons right">send</i>
                    </button>
                  </div>
                </div>
            </form>
        <?php } else { ?>
            <p>Esta nota no existe.</p>
        <?php } ?>
    </div>
</main>
