<main class="container">
    <div class="row">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <section class="col s12" >
            <h1 class="center">Tus materiales</h1>
            <form method="post" action="<?php echo Config::get('URL');?>material/create" enctype="multipart/form-data">
                <div class="row">
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="[0-9]{1,5}" name="material_provider_id" placeholder="Id Proveedor">
                    <label class="col s12 no-padding" for="material_provider_id" data-error="Introduzca una cifra (máximo 5 dígitos)" >Id Proveedor</label>
                  </div>
                  <div class="input-field col s12 m6 ">
                    <input type="text" class="validate" pattern="[0-9A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="material_name" placeholder="Nombre (letras 2-64 caracteres)" required autofocus>
                    <label class="col s12 no-padding" for="material_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Introduce nombre del material</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input type="text" class="validate" pattern="[0-9A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,100}" name="material_description" placeholder="Descripción (máximo 100 caracteres)">
                    <label class="col s12 no-padding" for="material_description" data-error="Sólo cifras, letras y espacios, de 2 a 100 caracteres" >Descripción</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="[0-9]{1,6}\.[0-9]{1,2}" name="material_price" placeholder="Precio (numero con 2 decimales)" required >
                    <label class="col s12 no-padding" for="material_price" data-error="Introduzca numero con 2 decimales" >Precio</label>
                  </div>
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="[0-9]{1,10}\.[0-9]{1,2}" name="material_weight" placeholder="Peso (numero con 2 decimales)" >
                    <label class="col s12 no-padding" for="material_weight" data-error="Introduzca numero con 2 decimales" >Peso</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[0-9]{1,10}\.[0-9]{1,2}" name="material_dimension_high" placeholder="Altura (numero con 2 decimales)" >
                    <label class="col s12 no-padding" for="material_dimension_high" data-error="Introduzca numero con 2 decimales" >Altura</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[0-9]{1,10}\.[0-9]{1,2}" name="material_dimension_width" placeholder="Anchura (numero con 2 decimales)" >
                    <label class="col s12 no-padding" for="material_dimension_width" data-error="Introduzca numero con 2 decimales" >Anchura</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[0-9]{1,10}\.[0-9]{1,2}" name="material_dimension_profound" placeholder="Profundidad  (numero con 2 decimales)" >
                    <label class="col s12 no-padding" for="material_dimension_profound" data-error="Introduzca numero con 2 decimales" >Profundidad</label>
                  </div>
                </div>
                <div class="row">
                  <div class="file-field input-field col s12">
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
                </div>
                <div class="row">
                  <div class="input-field col s12 m6 offset-m3 center">
                    <button class="btn waves-effect waves-light center" type="submit" autocomplete="off">Añadir material
                      <i class="material-icons right">add</i>
                    </button>
                  </div>
                </div>
            </form>
        </section>
    </div>

    <div class="row">
        <section class="col s12 center" >
        <?php if ($this->materials) { ?>
            <table class="responsive-table bordered striped centered">
                <thead>
                <tr>
                    <td class="center">Id</td>
                    <td class="center">Id Proveedor</td>
                    <td class="center">Nombre</td>
                    <td class="center">Descripción</td>
                    <td class="center">Foto</td>
                    <td class="center">Precio</td>
                    <td class="center">Peso</td>
                    <td class="center">Altura</td>
                    <td class="center">Anchura</td>
                    <td class="center">Profundidad</td>
                    <td class="center">EDITAR</td>
                    <td class="center">ELIMINAR</td>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($this->materials as $key => $value) { ?>
                        <tr>
                            <td><?= $value->material_id; ?></td>
                            <td><?= htmlentities($value->material_provider_id); ?></td>
                            <td><?= htmlentities($value->material_name); ?></td>
                            <td><?= htmlentities($value->material_description); ?></td>
                            <td><?php if (isset($value->material_photoMaterial_link)) { ?>
                                    <img src="<?= $value->material_photoMaterial_link; ?>" />
                                <?php } ?></td>
                            <td><?= htmlentities($value->material_price); ?></td>
                            <td><?= htmlentities($value->material_weight); ?></td>
                            <td><?= htmlentities($value->material_dimension_high); ?></td>
                            <td><?= htmlentities($value->material_dimension_width); ?></td>
                            <td><?= htmlentities($value->material_dimension_profound); ?></td>
                            <td><a class="btn-floating btn-large" href="<?= Config::get('URL') . 'material/edit/' . $value->material_id; ?>"><i class="large material-icons">mode_edit</i></a></td>
                            <td><a class="btn-floating btn-large" href="<?= Config::get('URL') . 'material/delete/' . $value->material_id; ?>"><i class="large material-icons">clear</i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <div>No hay ningún material aún. Créate alguno!</div>
            <?php } ?>
        </section>
    </div>
</main>
