<main class="container">
    <div class="row">
        <h1 class="center">Edita un provider</h1>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <section class="col s12" >

        <?php if ($this->provider) { ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>provider/editSave">
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="hidden" name="provider_id" value="<?php echo htmlentities($this->provider->provider_id); ?>" />
                    <input type="text" class="validate" pattern="^[A-Z][0-9]{8,8}$" name="provider_CIF" value="<?php echo htmlentities($this->provider->provider_CIF); ?>" required >
                    <label class="col s12 no-padding" for="provider_CIF" data-error="Introduzca 1 letra Mayuscula y 8 digitos" >Cambia CIF del proveedor</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="provider_name" value="<?php echo htmlentities($this->provider->provider_name); ?>" required >
                    <label class="col s12 no-padding" for="provider_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia nombre del proveedor</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="^([9|6][0-9]{8})$" name="provider_phone" value="<?php echo htmlentities($this->provider->provider_phone); ?>" required >
                    <label class="col s12 no-padding" for="provider_phone" data-error="el nº telefono debe de empezar por 9 o por 6 hasta alcanzar 9 digitos." >Cambia telefono</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s,]{2,64}" name="provider_address" value="<?php echo htmlentities($this->provider->provider_address); ?>" required >
                    <label class="col s12 no-padding" for="provider_address" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia domicilio</label>
                  </div>
                  <div class="col s12 m4">
                    <label for="provider_province" >Provincia</label>
                    <select class = "browser-default" id="provincia" name="provider_province" >
                      <option value="" >- Selecciona -</option>
                      <?php $provincias = UserModel::cargaProvincias();
                      foreach($provincias as $key => $value){
                        if($value->Codigo_provincia == $this->provider->provider_province){?>
                          <option value="<?=$value->Codigo_provincia; ?>" selected><?=$value->Nombre_provincia; ?></option>
                        <?php }else{?>
                          <option value="<?=$value->Codigo_provincia; ?>"><?=$value->Nombre_provincia; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col s12 m4">
                    <label for="provider_city_id">Poblacion</label>
                    <select class = "browser-default" name="provider_city_id" >
                      <?php $municipios = UserModel::cargaMunicipios($this->provider->provider_province);
                      foreach($municipios as $key => $value){
                        if($value->id_municipio == $this->provider->provider_city_id){?>
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
                    <input type="email" class="validate" name="provider_email" value="<?php echo htmlentities($this->provider->provider_email); ?>" required >
                    <label class="col s12 no-padding" for="provider_email" data-error="No se ajusta al patrón de un email" >Cambia direccion email</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="^[\w\s]{2,64}$" name="provider_url" value="<?php echo htmlentities($this->provider->provider_url); ?>" >
                    <label class="col s12 no-padding" for="provider_url" data-error="Introduzca una direccion web valida" >Cambia la direccion Web</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="provider_contact_name" value="<?php echo htmlentities($this->provider->provider_contact_name); ?>" required >
                    <label class="col s12 no-padding" for="provider_contact_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Cambia nombre de persona de contacto</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="provider_latitud" value="<?php echo htmlentities($this->provider->provider_latitud); ?>" required >
                    <label class="col s12 no-padding" for="provider_latitud" data-error="incorrecto: numeros decimales (use una coma)" >Cambia latitud</label>
                  </div>
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="provider_longitud" value="<?php echo htmlentities($this->provider->provider_longitud); ?>" required >
                    <label class="col s12 no-padding" for="provider_longitud" data-error="incorrecto: numeros decimales (use una coma)" >Cambia longitud</label>
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
            <p>Este proveedor no existe.</p>
        <?php } ?>
    </div>
</main>
