<main class="row" style="margin: 0 5%;">
  <h1 class="center">Gestion de Obra del encargado</h1>

  <!-- echo out the system feedback (error and success messages) -->
  <?php $this->renderFeedbackMessages(); ?>

  <h3 class="center">TUS MATERIALES DE OBRA</h3>
  <div class="row">
    <section class="col s12" >
      <?php if ($this->oeuvres_materials) { ?>
      <h4 class="center">OBRA: </h4>
      <table class="responsive-table bordered striped centered">
        <thead>
          <tr>
            <th>Id Proveedor</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Foto</th>
            <th>Precio</th>
            <th>Peso</th>
            <th>Altura</th>
            <th>Anchura</th>
            <th>Profundidad</th>
            <th>Cantidad</th>
            <th>Actualizar cantidad</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0 ?>
          <?php foreach($this->oeuvres_materials as $key => $value) { $i++; ?>
          <tr>
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
              <form method="post" action="<?= Config::get('URL') . 'dashboard/addQuantity/' . $value->oeuvre_id . '/' . $value->material_id; ?>">
                <td><input type="number" name="quantity" <?php if($value->quantity!= 0){?> value="<?=$value->quantity; ?>" <?php } ?>/></td>
                <td>
                  <input type="hidden" name="oeuvreMaterial_id" value="<?= $value->oeuvre_id; ?>" />
                  <button class="btn-floating btn-large" type="submit">
                    <i class="material-icons right">send</i>
                  </button>
                </td>
              </form>
              <td>
                <input type="hidden" name="oeuvreMaterial_id" value="<?= $value->oeuvre_id; ?>" />
                <a class="btn-floating btn-large" href="<?= Config::get('URL') . 'dashboard/delete/' . $value->oeuvre_id . '/' . $value->material_id; ?>"><i class="large material-icons">clear</i></a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php } else { ?>
        <div>No hay ningún material aún. Créate alguno!</div>
        <?php } ?>
      </section>
    </div>
    <h3 class="center">ESCOGE TUS MATERIALES</h3>
    <div class="row">
      <section class="col s12" >
        <?php if ($this->materials) { ?>
        <form method="post" action="<?= Config::get('URL') . 'dashboard/index/0/' . $this->itemsToShow . '/' . $this->orderBy; ?>">
          <div class="row red lighten-2">
            <div class="col s12 m4">
              <label class="col s12" for="orderBy">Ordenar por:</label>
              <select class = "browser-default" name="orderBy" >
                <?php $orderBy = (isset($this->orderBy)) ? $this->orderBy :  "material_id" ?>
                <option value="material_id" <?php if($orderBy=='material_id'){ echo 'selected';}?>>ID</option>
                <option value="material_provider_id" <?php if($orderBy=='material_provider_id'){ echo 'selected';}?>>Id Proveedor</option>
                <option value="material_name" <?php if($orderBy=='material_name'){ echo 'selected';}?>>Nombre</option>
                <option value="material_description" <?php if($orderBy=='material_description'){ echo 'selected';}?>>Descripción</option>
                <option value="material_price" <?php if($orderBy=='material_price'){ echo 'selected';}?>>Precio</option>
              </select>
            </div>
            <div class="input-field col s12 m4">
              <input type="number" name="itemsToShow" value="<?= $itemsToShow = (isset($this->itemsToShow)) ? $this->itemsToShow :  3 ?>" >
              <label class="col s12" for="itemsToShow" >Elementos a mostrar por página</label>
            </div>
            <div class="input-field col s12 m4">
              <button class="btn waves-effect waves-light center" type="submit" autocomplete="off">mostrar
                <i class="material-icons right">visibility</i>
              </button>
            </div>
          </div>
        </form>
        <form method="post" action="<?php echo Config::get('URL'); ?>dashboard/addSelect">
          <table class="responsive-table bordered striped centered">
            <thead>
              <tr>
                <th>#</th>
                <th>Id Proveedor</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Foto</th>
                <th>Precio</th>
                <th>Peso</th>
                <th>Altura</th>
                <th>Anchura</th>
                <th>Profundidad</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 0 ?>
              <?php foreach($this->materials as $key => $value) { $i++; ?>
              <tr>
                <td>
                  <input type="checkbox" name="check_list_Material[]" id="check_list[]<?= $i ?>" value="<?= $value->material_id; ?>" />
                  <label for="check_list[]<?= $i ?>"></label>
                </td>
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
                </tr>
                <?php } ?>
              </tbody>
            </table>

            <h3 class="center">TUS OBRAS</h3>
            <div class="row">
              <section class="col s12 center" >
                <?php if ($this->oeuvres) { ?>
                <table class="responsive-table bordered striped centered">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Presupuesto</th>
                      <th>Nombre</th>
                      <th>Domicilio</th>
                      <th>Provincia</th>
                      <th>Poblacion</th>
                      <th>Telefono</th>
                      <th>Email</th>
                      <th>Nick Encargado</th>
                      <th>Nombre Contacto</th>
                      <th>Latitud</th>
                      <th>Longitud</th>
                      <th>Fecha Inicio</th>
                      <th>Fecha Finalización</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0 ?>
                    <?php foreach($this->oeuvres as $key => $value) { $i++; ?>
                    <tr>
                      <td><input type="radio" name="oeuvre_id" id="oeuvre_id<?= $i ?>" value="<?= $value->oeuvre_id; ?>"/>
                        <label for="oeuvre_id<?= $i ?>"><?= $value->oeuvre_id; ?></label></td>
                        <td><?= htmlentities($value->oeuvre_budget); ?></td>
                        <td><?= htmlentities($value->oeuvre_name); ?></td>
                        <td><?= htmlentities($value->oeuvre_address); ?></td>
                        <td>
                          <?php $provincias = UserModel::cargaProvincias();
                          foreach($provincias as $key => $valueProvince){
                            if($valueProvince->Codigo_provincia == $value->oeuvre_province){?>
                            <?=$valueProvince->Nombre_provincia; ?>
                            <?php } ?>
                            <?php } ?>
                          </td>
                          <td>
                            <?php $municipios = UserModel::cargaMunicipios($value->oeuvre_province);
                            foreach($municipios as $key => $valueMunicipios){
                              if($valueMunicipios->id_municipio == $value->oeuvre_city_id){?>
                              <?=$valueMunicipios->nombre; ?>
                              <?php } ?>
                              <?php } ?>
                            </td>
                            <td><?= htmlentities($value->oeuvre_phone); ?></td>
                            <td><?= htmlentities($value->oeuvre_email); ?></td>
                            <?php $supervisors = UserModel::getPublicProfilesOfEmployeeUsers();
                            foreach($supervisors as $key => $content){
                              if($content->user_id == $value->supervisor_id) ?>
                              <td><?= htmlentities($content->user_name); ?></td>
                              <?php }?>
                              <td><?= htmlentities($value->oeuvre_contact_name); ?></td>
                              <td><?= htmlentities($value->oeuvre_latitud); ?></td>
                              <td><?= htmlentities($value->oeuvre_longitud); ?></td>
                              <td><?= htmlentities($value->oeuvre_startDate); ?></td>
                              <td><?= htmlentities($value->oeuvre_completionDate); ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                        <?php } else { ?>
                        <div>No hay ninguna obra asociada a tí. ¡Habla con el jefe!</div>
                        <?php } ?>
                      </section>
                    </div>
                    <div class="row">
                      <div class="input-field col s12 m6 offset-m3 center">
                        <button class="btn waves-effect waves-light center" type="submit" >Añade seleccionados a tu obra
                          <i class="material-icons right">add</i>
                        </button>
                      </div>
                    </div>
                  </form>
                </section>
              </div>
              <ul class="pagination center">
                <?php if($this->totalPages > 1) {
                  if($this->page != 1){ ?>
                  <li class="waves-effect"><a href="<?= Config::get('URL') . 'dashboard/index/' . ($this->page - 1) . '/' . $this->itemsToShow . '/' . $this->orderBy; ?>"><i class="material-icons">chevron_left</i></a></li>
                  <?php }
                  for($i = 1 ; $i <= $this->totalPages ; $i++){
                    if($this->page == $i) {?>
                    <li class="active"><a href="#!"><?= $this->page ?></a></li>
                    <?php } else {?>
                    <li class="waves-effect"><a href="<?= Config::get('URL') . 'dashboard/index/' . $i . '/' . $this->itemsToShow . '/' . $this->orderBy; ?>"><?= $i ?></a></li>
                    <?php }
                  }
                  if($this->page != $this->totalPages){?>
                  <li class="waves-effect"><a href="<?= Config::get('URL') . 'dashboard/index/' . ($this->page + 1) . '/' . $this->itemsToShow . '/' . $this->orderBy; ?>"><i class="material-icons">chevron_right</i></a></li>
                  <?php }
                } ?>
              </ul>
              <?php } else { ?>
              <div>No hay ningún material aún. El administrador tiene que añadir alguno!</div>
              <?php } ?>
            </main>
