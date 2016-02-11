<main class="container">
    <div class="row">
        <h1 class="center">Edita un obra</h1>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <section class="col s12" >

        <?php if ($this->oeuvre) { ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>oeuvre/editSave">
                <div class="row">
                  <div class="input-field col s12 m3">
                    <input type="hidden" name="oeuvre_id" value="<?php echo htmlentities($this->oeuvre->oeuvre_id); ?>" />
                    <input type="text" class="validate" pattern="[0-9]{1,6}\.[0-9]{1,2}" name="oeuvre_budget" value="<?php echo htmlentities($this->oeuvre->oeuvre_budget); ?>" required >
                    <label class="col s12 no-padding" for="oeuvre_budget" data-error="Introduzca numero con 2 decimales, separado por un punto." >Cambia Presupuesto de la obra</label>
                  </div>
                  <div class="input-field col s12 m3">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="oeuvre_name" value="<?php echo htmlentities($this->oeuvre->oeuvre_name); ?>" required >
                    <label class="col s12 no-padding" for="oeuvre_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia nombre de la obra</label>
                  </div>
                  <div class="col s12 m3">
                    <label for="user_id" >Introduce nombre del empleado</label>
                    <select class = "browser-default" name="user_id" >
                      <option value="" >- Selecciona -</option>
                      <?php $Employee = UserModel::getPublicProfilesOfEmployeeUsers();
                      foreach($Employee as $key => $value){
                        if($value->user_id == $this->oeuvre->user_id){?>
                          <option value="<?=$value->user_id; ?>" selected><?=$value->user_name; ?></option>
                        <?php }else{?>
                          <option value="<?=$value->user_id; ?>"><?=$value->user_name; ?></option>
                        <?php } ?>
                      <?php }?>
                    </select>
                  </div>
                  <div class="input-field col s12 m3">
                    <input type="text" class="validate" pattern="^([9|6][0-9]{8})$" name="oeuvre_phone" value="<?php echo htmlentities($this->oeuvre->oeuvre_phone); ?>" required >
                    <label class="col s12 no-padding" for="oeuvre_phone" data-error="el nº telefono debe de empezar por 9 o por 6 hasta alcanzar 9 digitos." >Cambia telefono</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m3">
                    <input type="text" class="validate" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s,]{2,64}" name="oeuvre_address" value="<?php echo htmlentities($this->oeuvre->oeuvre_address); ?>" required >
                    <label class="col s12 no-padding" for="oeuvre_address" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia domicilio</label>
                  </div>
                  <div class="col s12 m3">
                    <label for="oeuvre_province" >Provincia</label>
                    <select class = "browser-default" id="provincia" name="oeuvre_province" >
                      <option value="" >- Selecciona -</option>
                      <?php $provincias = UserModel::cargaProvincias();
                      foreach($provincias as $key => $value){
                        if($value->Codigo_provincia == $this->oeuvre->oeuvre_province){?>
                          <option value="<?=$value->Codigo_provincia; ?>" selected><?=$value->Nombre_provincia; ?></option>
                        <?php }else{?>
                          <option value="<?=$value->Codigo_provincia; ?>"><?=$value->Nombre_provincia; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col s12 m3">
                    <label for="oeuvre_city_id">Poblacion</label>
                    <select class = "browser-default" name="oeuvre_city_id" >
                      <?php $municipios = UserModel::cargaMunicipios($this->oeuvre->oeuvre_province);
                      foreach($municipios as $key => $value){
                        if($value->id_municipio == $this->oeuvre->oeuvre_city_id){?>
                          <option value="<?=$value->id_municipio; ?>" selected><?=$value->nombre; ?></option>
                        <?php }else{?>
                          <option value="<?=$value->id_municipio; ?>"><?=$value->nombre; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="input-field col s12 m3">
                    <input type="email" class="validate" name="oeuvre_email" value="<?php echo htmlentities($this->oeuvre->oeuvre_email); ?>" required >
                    <label class="col s12 no-padding" for="oeuvre_email" data-error="No se ajusta al patrón de un email" >Cambia direccion email</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="oeuvre_contact_name" value="<?php echo htmlentities($this->oeuvre->oeuvre_contact_name); ?>" required >
                    <label class="col s12 no-padding" for="oeuvre_contact_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia nombre de persona de contacto</label>
                  </div>
                  <div class="input-field col s12 m2">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="oeuvre_latitud" value="<?php echo htmlentities($this->oeuvre->oeuvre_latitud); ?>" >
                    <label class="col s12 no-padding" for="oeuvre_latitud" data-error="incorrecto: numeros decimales (use una coma)" >Cambia latitud</label>
                  </div>
                  <div class="input-field col s12 m2">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="oeuvre_longitud" value="<?php echo htmlentities($this->oeuvre->oeuvre_longitud); ?>" >
                    <label class="col s12 no-padding" for="oeuvre_longitud" data-error="incorrecto: numeros decimales (use una coma)" >Cambia longitud</label>
                  </div>
                  <div class="input-field col s12 m2">
                    <input type="text" class="validate" pattern="(\d{4})(-)([0][1-9]|[1][0-2])\2([0][1-9]|[12][0-9]|3[01])" name="oeuvre_startDate" value="<?= $this->oeuvre->oeuvre_startDate; ?>" required >
                    <label class="col s12 no-padding" for="oeuvre_startDate" data-error="Introduzca una fecha con formato AAAA-MM-DD" >Cambia Fecha Inicio</label>
                  </div>
                  <div class="input-field col s12 m2">
                    <input type="text" class="validate" pattern="(\d{4})(-)([0][1-9]|[1][0-2])\2([0][1-9]|[12][0-9]|3[01])" name="oeuvre_completionDate" value="<?= $this->oeuvre->oeuvre_completionDate; ?>" required >
                    <label class="col s12 no-padding" for="oeuvre_completionDate" data-error="Introduzca una fecha con formato AAAA-MM-DD" >Cambia Fecha Finalización</label>
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
            <p>Esta obra no existe.</p>
        <?php } ?>
    </div>
</main>
