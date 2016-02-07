<main class="container">
    <div class="row">
        <h1 class="center">Edita un material</h1>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <section class="col s12" >

        <?php if ($this->material) { ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>material/editSave" enctype="multipart/form-data" >
                <div class="row">
                  <div class=" col s12 m4 center">
                    <h5>Imagen del material:</h5>
                    <?php if (isset($this->material->material_photoMaterial_link)) { ?>
                        <img src="<?= $this->material->material_photoMaterial_link; ?>" />
                    <?php } ?>
                  </div>
                  <div class="file-field input-field col s12 m4">
                    <div class="btn">
                      <span>Seleccione una imagen del material de su disco duro (será reducida a 60x60 px, actualmente sólo .jpg):</span>
                      <input type="file" name="photoMaterial_file" >
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text">
                    </div>
                    <!-- max size 5 MB (as many people directly upload high res pictures from their digital cameras) -->
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                  </div>
                  <div class="col s12 m4 center" >
                    <h5>Eliminar tu foto del material:</h5>
                    <a class="btn-floating btn-large" href="<?= Config::get('URL') . 'material/deletePhotoMaterial_action/' . $this->material->material_id; ?>"><i class="large material-icons">clear</i></a>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="hidden" name="material_id" value="<?php echo htmlentities($this->material->material_id); ?>" />
                    <input type="text" class="validate" pattern="[0-9]{1,5}" name="material_provider_id" value="<?php echo htmlentities($this->material->material_provider_id); ?>">
                    <label class="col s12 no-padding" for="material_provider_id" data-error="Introduzca una cifra (máximo 5 dígitos)" >Cambia Id Proveedor</label>
                  </div>
                  <div class="input-field col s12 m4 ">
                    <input type="text" class="validate" pattern="[0-9A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="material_name" value="<?php echo htmlentities($this->material->material_name); ?>" required >
                    <label class="col s12 no-padding" for="material_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia nombre del material</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[0-9]{1,6}\.[0-9]{1,2}" name="material_price" value="<?php echo htmlentities($this->material->material_price); ?>" required >
                    <label class="col s12 no-padding" for="material_price" data-error="Introduzca numero con 2 decimales" >Cambia Precio</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input type="text" class="validate" pattern="[0-9A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,100}" name="material_description" value="<?php echo htmlentities($this->material->material_description); ?>">
                    <label class="col s12 no-padding" for="material_description" data-error="Sólo cifras, letras y espacios, de 2 a 100 caracteres" >Cambia Descripción</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m3">
                    <input type="text" class="validate" pattern="[0-9]{1,10}\.[0-9]{1,2}" name="material_weight" value="<?php echo htmlentities($this->material->material_weight); ?>" >
                    <label class="col s12 no-padding" for="material_weight" data-error="Introduzca numero con 2 decimales" >Cambia Peso</label>
                  </div>
                  <div class="input-field col s12 m3">
                    <input type="text" class="validate" pattern="[0-9]{1,10}\.[0-9]{1,2}" name="material_dimension_high" value="<?php echo htmlentities($this->material->material_dimension_high); ?>" >
                    <label class="col s12 no-padding" for="material_dimension_high" data-error="Introduzca numero con 2 decimales" >Cambia Altura</label>
                  </div>
                  <div class="input-field col s12 m3">
                    <input type="text" class="validate" pattern="[0-9]{1,10}\.[0-9]{1,2}" name="material_dimension_width" value="<?php echo htmlentities($this->material->material_dimension_width); ?>" >
                    <label class="col s12 no-padding" for="material_dimension_width" data-error="Introduzca numero con 2 decimales" >Cambia Anchura</label>
                  </div>
                  <div class="input-field col s12 m3">
                    <input type="text" class="validate" pattern="[0-9]{1,10}\.[0-9]{1,2}" name="material_dimension_profound" value="<?php echo htmlentities($this->material->material_dimension_profound); ?>" >
                    <label class="col s12 no-padding" for="material_dimension_profound" data-error="Introduzca numero con 2 decimales" >Cambia Profundidad</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6 offset-m3 center">
                    <button class="btn waves-effect waves-light center" type="submit" autocomplete="off">Cambia
                      <i class="material-icons right">send</i>
                    </button>
                  </div>
                </div>
            </form>
        <?php } else { ?>
            <p>Este material no existe.</p>
        <?php } ?>
        </section>
    </div>
    <div class="row">
  </div>
</main>
