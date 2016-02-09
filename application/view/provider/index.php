<main class="container">
    <div class="row">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <section class="col s12" >
            <h1 class="center">Tus proveedores</h1>
            <form method="post" action="<?php echo Config::get('URL');?>provider/create">
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="^[A-Z][0-9]{8,8}$" name="provider_CIF" placeholder="CIF (1 letra Mayuscula y 8 digitos)" required autofocus>
                    <label class="col s12 no-padding" for="provider_CIF" data-error="Introduzca 1 letra Mayuscula y 8 digitos" >C.I.F.</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="provider_name" placeholder="Nombre (letras 2-64 caracteres)" required autofocus>
                    <label class="col s12 no-padding" for="provider_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Introduce nombre del proveedor</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="^([9|6][0-9]{8})$" name="provider_phone" placeholder="Telefono de contacto ([6|9]12345678)" required >
                    <label class="col s12 no-padding" for="provider_phone" data-error="el nº telefono debe de empezar por 9 o por 6 hasta alcanzar 9 digitos." >Teléfono</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s,]{2,64}" name="provider_address" placeholder="Domicilio (letras/numeros, 2-64 caracteres)" required >
                    <label class="col s12 no-padding" for="provider_address" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Domicilio</label>
                  </div>
                  <div class="col s12 m4">
                    <label for="provider_province" >Provincia</label>
                    <select class = "browser-default" id="provincia" name="provider_province" >
                      <option value="" >- Selecciona -</option>
                      <?php $provincias = UserModel::cargaProvincias();
                      foreach($provincias as $key => $value){ ?>
                        <option value="<?=$value->Codigo_provincia; ?>"><?=$value->Nombre_provincia; ?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="col s12 m4">
                    <label for="provider_city_id">Poblacion</label>
                    <select class = "browser-default" id="municipio" name="provider_city_id">
                      <option disabled>selecciona una provincia</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="email" class="validate" name="provider_email" placeholder="Dirección email (una dirección real)" required >
                    <label class="col s12 no-padding" for="provider_email" data-error="No se ajusta al patrón de un email" >Dirección email</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="^[\w\s]{2,64}$" name="provider_url" placeholder="direccion web (opcional)" >
                    <label class="col s12 no-padding" for="provider_url" data-error="Introduzca una direccion web valida" >Introduzca una direccion Web (opcional)</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="provider_contact_name" placeholder="Nombre (letras 2-64 caracteres)" required >
                    <label class="col s12 no-padding" for="provider_contact_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Introduce nombre de persona de contacto</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="provider_latitud" >
                    <label class="col s12 no-padding" for="provider_latitud" data-error="incorrecto: numeros decimales (use un punto)" >Latitud</label>
                  </div>
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="provider_longitud" >
                    <label class="col s12 no-padding" for="provider_longitud" data-error="incorrecto: numeros decimales (use un punto)" >Longitud</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6 offset-m3 center">
                    <button class="btn waves-effect waves-light center" type="submit" autocomplete="off">Añadir proveedor
                      <i class="material-icons right">add</i>
                    </button>
                  </div>
                </div>
            </form>
        </section>
    </div>

    <div class="row">
        <section class="col s12 center" >
        <?php if ($this->providers) { ?>
            <table class="responsive-table bordered striped centered">
                <thead>
                  <tr>
                      <th>Id</th>
                      <th>CIF</th>
                      <th>Nombre</th>
                      <th>Domicilio</th>
                      <th>Provincia</th>
                      <th>Poblacion</th>
                      <th>Telefono</th>
                      <th>Email</th>
                      <th>Direccion Web</th>
                      <th>Nombre Contacto</th>
                      <th>Latitud</th>
                      <th>Longitud</th>
                      <th>EDITAR</th>
                      <th>ELIMINAR</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($this->providers as $key => $value) { ?>
                    <tr>
                      <td><?= $value->provider_id; ?></td>
                      <td><?= htmlentities($value->provider_CIF); ?></td>
                      <td><?= htmlentities($value->provider_name); ?></td>
                      <td><?= htmlentities($value->provider_address); ?></td>
                      <td>
                        <?php $provincias = UserModel::cargaProvincias();
                        foreach($provincias as $key => $valueProvince){
                          if($valueProvince->Codigo_provincia == $value->provider_province){?>
                            <?=$valueProvince->Nombre_provincia; ?>
                          <?php } ?>
                        <?php } ?>
                      </td>
                      <td>
                        <?php $municipios = UserModel::cargaMunicipios($value->provider_province);
                        foreach($municipios as $key => $valueMunicipios){
                          if($valueMunicipios->id_municipio == $value->provider_city_id){?>
                            <?=$valueMunicipios->nombre; ?>
                          <?php } ?>
                        <?php } ?>
                      </td>
                      <td><?= htmlentities($value->provider_phone); ?></td>
                      <td><?= htmlentities($value->provider_email); ?></td>
                      <td><?= htmlentities($value->provider_url); ?></td>
                      <td><?= htmlentities($value->provider_contact_name); ?></td>
                      <td><?= htmlentities($value->provider_latitud); ?></td>
                      <td><?= htmlentities($value->provider_longitud); ?></td>
                      <td><a class="btn-floating btn-large" href="<?= Config::get('URL') . 'provider/edit/' . $value->provider_id; ?>"><i class="large material-icons">mode_edit</i></a></td>
                      <td><a class="btn-floating btn-large" href="<?= Config::get('URL') . 'provider/delete/' . $value->provider_id; ?>"><i class="large material-icons">clear</i></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <div>No hay ningún proveedor aún. Créate alguno!</div>
            <?php } ?>
        </section>
    </div>
</main>
<script type="text/javascript">
    var peticion = null;

    function inicializa_xhr() {
      if(window.XMLHttpRequest) {
        return new XMLHttpRequest();
      } else if (window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
      }
    }

    function cargaMunicipios() {
      var lista = document.getElementById("provincia");
      var provincia = lista.options[lista.selectedIndex].value;
      if(!isNaN(provincia)) {
        peticion = inicializa_xhr();
        if (peticion) {
          peticion.onreadystatechange = muestraMunicipios;
          peticion.open("POST", url + "register/loadCity?nocache=" + Math.random(), true);
          peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          peticion.send("provincia=" + provincia);
        }
      }
    }

    function muestraMunicipios() {
      if (peticion.readyState == 4) {
        if (peticion.status == 200) {
          var lista = document.getElementById("municipio");
          var municipios = eval('(' + peticion.responseText + ')');

          lista.options.length = 0;
          var i=0;
          for(var codigo in municipios) {
            lista.options[i] = new Option(municipios[codigo], codigo);
            i++;
          }
        }
      }
    }

    window.onload = function() {
      peticion = inicializa_xhr();

      document.getElementById("provincia").onchange = cargaMunicipios;
    };
  </script>;
