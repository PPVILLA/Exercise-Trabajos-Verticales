<main class="row" style="margin: 0 5%;">
  <h1 class="center">Gestion de Obra del encargado</h1>

  <!-- echo out the system feedback (error and success messages) -->
  <?php $this->renderFeedbackMessages(); ?>
  <h3 class="red lighten-2 white-text center">TUS FOTOS DE OBRA:</h3>
  <form enctype="multipart/form-data" method="post" action="<?= Config::get('URL');?>dashboard/addPhotoToOeuvre">
    <div class="row">
      <h4 class="center">Haz fotos a la obra (primero tienes que tener materiales asignados a tu obra): </h4>
      <div class="file-field input-field col s12 m8">
        <div class="btn">
          <span>Haz una foto de la obra desde de tu dispositivo :</span>
          <input type="file" name="photoOeuvre_file" accept="image/*" capture="camera" >
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
        <!-- max size 5 MB (as many people directly upload high res pictures from their digital cameras) -->
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
      </div>
      <div class="input-field col s12 m4 center">
        <?php foreach($this->oeuvres_materials as $key => $value) { ?>
        <input type="hidden" name="oeuvre_id" value="<?= $value->oeuvre_id; ?>" /><?php } ?>
        <button class="btn-large waves-effect waves-light center" type="submit" >Añadir foto a tu obra
          <i class="material-icons right">add</i>
        </button>
      </div>
    </div>
  </form>
  <div class="row">
    <section class="col s12" >
      <?php if ($this->oeuvres_photos) { ?>
      <form method="post" action="<?php echo Config::get('URL'); ?>dashboard/deleteSelect">
          <table class="responsive-table bordered striped centered">
              <thead>
              <tr>
                  <th>#</th>
                  <th>Id</th>
                  <th>Nombre Obra</th>
                  <th>Nombre encargado</th>
                  <th>Foto</th>
                  <th>ELIMINAR</th>
              </tr>
              </thead>
              <tbody>
                  <?php $i = 0 ?>
                  <?php foreach($this->oeuvres_photos as $key => $value) { $i++; ?>
                      <tr>
                          <td>
                            <input type="checkbox" name="check_list_PhotoOeuvres[]" id="check_list_PhotoOeuvres[]<?= $i ?>" value="<?= $value->oeuvre_photo_id; ?>" />
                            <label for="check_list_PhotoOeuvres[]<?= $i ?>"></label>
                          </td>
                          <td><?= $value->oeuvre_photo_id; ?></td>
                          <td><?= htmlentities($value->oeuvre_name); ?></td>
                          <td><?= htmlentities($value->employee_name); ?></td>
                          <td><?php if (isset($value->oeuvrePhoto_photoOeuvre_link)) { ?>
                                  <img src="<?= $value->oeuvrePhoto_photoOeuvre_link; ?>" />
                              <?php } ?></td>
                          <td><a class="btn-floating btn-large" href="<?= Config::get('URL') . 'dashboard/deletePhotoOeuvre/' . $value->oeuvre_photo_id; ?>"><i class="large material-icons">clear</i></a></td>
                      </tr>
                  <?php } ?>
              </tbody>
          </table>
          <div class="row">
            <div class="input-field col s12 m6 offset-m3 center">
              <button class="btn waves-effect waves-light center" type="submit" >Borra seleccionados
                <i class="material-icons right">clear</i>
              </button>
            </div>
          </div>
        </form>
      <?php } else { ?>
      <div>No hay ninguna foto realizada para tu obra aún.</div>
      <?php } ?>
    </section>
  </div>
  <h3 class="red lighten-2 white-text center">TUS MATERIALES DE OBRA:</h3>
  <div class="row">
    <section class="col s12" >
      <?php if ($this->oeuvres_materials) { ?>
      <?php foreach($this->oeuvres as $key => $value) { ?>
      <h4 class="center">OBRA:<?= $value->oeuvre_name; ?> </h4><?php } ?>
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
        <div>No hay ningún material seleccionado para tu obra aún. Selecciona aquí abajo (no te vayas a pasar del presupuesto!)</div>
        <?php } ?>
      </section>
    </div>
    <div class="row red lighten-2">
      <section class="col s12" >
        <?php if ($this->materials) { ?>
        <form method="post" action="<?= Config::get('URL') . 'dashboard/index/' ?>">
          <div class="row ">
            <h4 class="white-text center">Filtro de búsqueda de materiales:</h4>
            <div class="input-field col s12 m3">
              <input type="text" name="suggestion" value="<?= $suggestion = (isset($this->suggestion)) ? $this->suggestion :  '' ?>" >
              <label class="col s12" for="suggestion" >Introduce sugerencia de búsqueda:</label>
            </div>
            <div class="col s12 m3">
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
            <div class="input-field col s12 m3">
              <input type="number" name="itemsToShow" value="<?= $itemsToShow = (isset($this->itemsToShow)) ? $this->itemsToShow :  3 ?>" >
              <label class="col s12" for="itemsToShow" >Elementos a mostrar por página</label>
            </div>
            <div class="input-field col s12 m3">
              <button class="btn waves-effect waves-light center" type="submit" autocomplete="off">mostrar
                <i class="material-icons right">visibility</i>
              </button>
            </div>
          </div>
        </form>
        <form method="post" action="<?php echo Config::get('URL'); ?>dashboard/addSelect">
        <div class="row light-blue">
          <h4 class="center">Selecciona una de TUS OBRAS para añadirle materiales</h4>
          <section class="col s12" >
            <?php if ($this->oeuvres) { ?>
            <table class="responsive-table bordered striped centered">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Cliente</th>
                  <th>Presupuesto</th>
                  <th>Nombre</th>
                  <th>Domicilio</th>
                  <th>Provincia</th>
                  <th>Poblacion</th>
                  <th>Telefono</th>
                  <th>Email</th>
                  <th>Nick Encargado</th>
                  <th>Nombre Contacto</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Finalización</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0 ?>
                <?php foreach($this->oeuvres as $key => $value) { $i++; ?>
                <tr>
                  <td><input type="radio" name="oeuvre_id" id="oeuvre_id<?= $i ?>" value="<?= $value->oeuvre_id; ?>"/>
                    <label for="oeuvre_id<?= $i ?>"><?= $value->oeuvre_id; ?></label>
                  </td>
                  <?php $userClients = UserModel::getPublicProfilesOfAllUsersClient();
                      foreach($userClients as $key => $content){
                        if($content->user_id == $value->user_id) {?>
                        <td><?= htmlentities($content->user_name); ?></td>
                        <?php } ?>
                  <?php } ?>
                  <td><?= htmlentities($value->oeuvre_budget); ?></td>
                  <td><?= htmlentities($value->oeuvre_name); ?></td>
                  <td><?= htmlentities($value->oeuvre_address); ?></td>
                  <td>
                    <?php $provincias = UserModel::cargaProvincias();
                    foreach($provincias as $key => $valueProvince){
                      if($valueProvince->Codigo_provincia == $value->oeuvre_province){ ?>
                      <?=$valueProvince->Nombre_provincia; ?>
                      <?php } ?>
                    <?php } ?>
                  </td>
                  <td>
                    <?php $municipios = UserModel::cargaMunicipios($value->oeuvre_province);
                    foreach($municipios as $key => $valueMunicipios){
                      if($valueMunicipios->id_municipio == $value->oeuvre_city_id){ ?>
                      <?=$valueMunicipios->nombre; ?>
                      <?php } ?>
                      <?php } ?>
                  </td>
                  <td><?= htmlentities($value->oeuvre_phone); ?></td>
                  <td><?= htmlentities($value->oeuvre_email); ?></td>
                  <?php $supervisors = UserModel::getPublicProfilesOfEmployeeUsers();
                    foreach($supervisors as $key => $content){
                      if($content->user_id == $value->supervisor_id) {?>
                      <td><?= htmlentities($content->user_name); ?></td>
                      <?php } ?>
                  <?php } ?>
                  <td><?= htmlentities($value->oeuvre_contact_name); ?></td>
                  <td><?= htmlentities($value->oeuvre_startDate); ?></td>
                  <td><?= htmlentities($value->oeuvre_completionDate); ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <?php } else { ?>
            <div>No hay ninguna obra asociada a tí. ¡Habla con el jefe!</div>
            <?php } ?>
            <div class="row light-blue lighten-4">
              <h4 class="center">Ahora escoge tus materiales:</h4>
              <table class="col s12 responsive-table bordered striped centered">
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
                      <?php } ?>
                    </td>
                    <td><?= htmlentities($value->material_price); ?></td>
                    <td><?= htmlentities($value->material_weight); ?></td>
                    <td><?= htmlentities($value->material_dimension_high); ?></td>
                    <td><?= htmlentities($value->material_dimension_width); ?></td>
                    <td><?= htmlentities($value->material_dimension_profound); ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 offset-m3 center">
                <button class="btn waves-effect waves-light center" type="submit" >Añade seleccionados a tu obra
                  <i class="material-icons right">add</i>
                </button>
              </div>
            </div>
          </section>
        </div>
        </form>
      </section>
    </div>
    <ul class="pagination center">
      <?php if($this->totalPages > 1) {
        if($this->page != 1){ ?>
          <form method="post" action="<?= Config::get('URL') . 'dashboard/index/' . ($this->page - 1) ?>">
            <input type="hidden" name="suggestion" value="<?= $this->suggestion; ?>" />
            <input type="hidden" name="itemsToShow" value="<?= $this->itemsToShow; ?>" />
            <input type="hidden" name="orderBy" value="<?= $this->orderBy; ?>" />
            <button class="btn-flat waves-effect" type="submit" ><i class="large material-icons">chevron_left</i></button>
          </form>
        <?php }
        for($i = 1 ; $i <= $this->totalPages ; $i++){
          if($this->page == $i) {?>
            <li class="active"><a href=""><?= $this->page ?></a></li>
          <?php } else { ?>
            <form method="post" action="<?= Config::get('URL') . 'dashboard/index/' . $i ?>">
              <input type="hidden" name="suggestion" value="<?= $this->suggestion; ?>" />
              <input type="hidden" name="itemsToShow" value="<?= $this->itemsToShow; ?>" />
              <input type="hidden" name="orderBy" value="<?= $this->orderBy; ?>" />
              <button class="btn-flat waves-effect" type="submit" ><?= $i ?></button>
            </form>
          <?php }
          }
          if($this->page != $this->totalPages){ ?>
          <form method="post" action="<?= Config::get('URL') . 'dashboard/index/' . ($this->page + 1) ?>">
            <input type="hidden" name="suggestion" value="<?= $this->suggestion; ?>" />
            <input type="hidden" name="itemsToShow" value="<?= $this->itemsToShow; ?>" />
            <input type="hidden" name="orderBy" value="<?= $this->orderBy; ?>" />
            <button class="btn-flat waves-effect" type="submit" ><i class="large material-icons">chevron_right</i></button>
          </form>
          <?php }
        } ?>
      </ul>
    <?php } else { ?>
    <div>No hay ningún material aún con esa sugerencia de búsqueda. El administrador tiene que añadir alguno!</div>
    <?php } ?>
  </main>
