<main class="container">
    <div class="row">
        <h1 class="center">Edita un material</h1>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <section class="col s12" >

        <?php if ($this->material) { ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>material/editSave">
                <div class="row">
                  <div class="input-field col s12 m6 offset-m3">
                    <input type="hidden" name="material_id" value="<?php echo htmlentities($this->material->material_id); ?>" />
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="material_name" value="<?php echo htmlentities($this->material->material_name); ?>" required >
                    <label class="col s12 no-padding" for="material_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia nombre del material</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s,]{2,64}" name="material_price" value="<?php echo htmlentities($this->material->material_price); ?>" required >
                    <label class="col s12 no-padding" for="material_price" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia domicilio</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[0-9A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="material_weight" value="<?php echo htmlentities($this->material->material_weight); ?>" required >
                    <label class="col s12 no-padding" for="material_weight" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia poblacion</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="^(\+34\s?)([9|6][0-9]{8})$|^([9|6][0-9]{8})$" name="material_dimension_high" value="<?php echo htmlentities($this->material->material_dimension_high); ?>" required >
                    <label class="col s12 no-padding" for="material_dimension_high" data-error="incorrecto" >Cambia telefono</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6">
                    <input type="email" class="validate" name="material_dimension_width" value="<?php echo htmlentities($this->material->material_dimension_width); ?>" required >
                    <label class="col s12 no-padding" for="material_dimension_width" data-error="No se ajusta al patrón de un email" >Cambia direccion email</label>
                  </div>
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="material_dimension_profound" value="<?php echo htmlentities($this->material->material_dimension_profound); ?>" required >
                    <label class="col s12 no-padding" for="material_dimension_profound" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia nombre de persona de contacto</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="material_provider_id" value="<?php echo htmlentities($this->material->material_provider_id); ?>" required >
                    <label class="col s12 no-padding" for="material_provider_id" data-error="incorrecto: numeros decimales (use una coma)" >Cambia latitud</label>
                  </div>
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="material_photo" value="<?php echo htmlentities($this->material->material_photo); ?>" required >
                    <label class="col s12 no-padding" for="material_photo" data-error="incorrecto: numeros decimales (use una coma)" >Cambia longitud</label>
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
