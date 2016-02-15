<main class="row" style="margin: 0 5%;">
    <div class="row">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <section class="col s12" >
            <h1 class="center">Tus obras</h1>
            <form method="post" action="<?php echo Config::get('URL');?>oeuvre/create">
                <div class="row">
                  <div class="input-field col s12 m3">
                    <input type="text" class="validate" pattern="[0-9]{1,6}\.[0-9]{1,2}" name="oeuvre_budget" placeholder="Presupuesto (numero con 2 decimales)" required autofocus>
                    <label class="col s12 no-padding" for="oeuvre_budget" data-error="Introduzca numero con 2 decimales, separado por un punto." >Presupuesto</label>
                  </div>
                  <div class="input-field col s12 m3">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="oeuvre_name" placeholder="Nombre (letras 2-64 caracteres)" required autofocus>
                    <label class="col s12 no-padding" for="oeuvre_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Introduce nombre de la obra</label>
                  </div>
                  <div class="col s12 m3">
                    <label for="user_id" >Selecciona nick del empleado</label>
                    <select class = "browser-default" name="supervisor_id" >
                      <option value="" >- Selecciona -</option>
                      <?php $Employee = UserModel::getPublicProfilesOfEmployeeUsers();
                      foreach($Employee as $key => $value){ ?>
                        <option value="<?=$value->user_id; ?>"><?=$value->user_name; ?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="input-field col s12 m3">
                    <input type="text" class="validate" pattern="^([9|6][0-9]{8})$" name="oeuvre_phone" placeholder="Telefono de contacto ([6|9]12345678)" required >
                    <label class="col s12 no-padding" for="oeuvre_phone" data-error="el nº telefono debe de empezar por 9 o por 6 hasta alcanzar 9 digitos." >Teléfono</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m3">
                    <input type="text" class="validate" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s,]{2,64}" name="oeuvre_address" placeholder="Domicilio (letras/numeros, 2-64 caracteres)" required >
                    <label class="col s12 no-padding" for="oeuvre_address" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Domicilio</label>
                  </div>
                  <div class="col s12 m3">
                    <label for="oeuvre_province" >Provincia</label>
                    <select class = "browser-default" id="provincia" name="oeuvre_province" >
                      <option value="" >- Selecciona -</option>
                      <?php $provincias = UserModel::cargaProvincias();
                      foreach($provincias as $key => $value){ ?>
                        <option value="<?=$value->Codigo_provincia; ?>"><?=$value->Nombre_provincia; ?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="col s12 m3">
                    <label for="oeuvre_city_id">Poblacion</label>
                    <select class = "browser-default" id="municipio" name="oeuvre_city_id">
                      <option disabled>selecciona una provincia</option>
                    </select>
                  </div>
                  <div class="input-field col s12 m3">
                    <input type="email" class="validate" name="oeuvre_email" placeholder="Dirección email (una dirección real)" required >
                    <label class="col s12 no-padding" for="oeuvre_email" data-error="No se ajusta al patrón de un email" >Dirección email</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="oeuvre_contact_name" placeholder="Nombre (letras 2-64 caracteres)" required >
                    <label class="col s12 no-padding" for="oeuvre_contact_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Introduce nombre de persona de contacto</label>
                  </div>
                  <div class="input-field col s12 m2">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="oeuvre_latitud" >
                    <label class="col s12 no-padding" for="oeuvre_latitud" data-error="incorrecto: numeros decimales (use un punto)" >Latitud</label>
                  </div>
                  <div class="input-field col s12 m2">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="oeuvre_longitud" >
                    <label class="col s12 no-padding" for="oeuvre_longitud" data-error="incorrecto: numeros decimales (use un punto)" >Longitud</label>
                  </div>
                  <div class="input-field col s12 m2">
                    <input type="text" class="validate" pattern="(\d{4})(-)([0][1-9]|[1][0-2])\2([0][1-9]|[12][0-9]|3[01])" name="oeuvre_startDate" value="<?= date("Y-m-d"); ?>" required >
                    <label class="col s12 no-padding" for="oeuvre_startDate" data-error="Introduzca una fecha con formato AAAA-MM-DD" >Fecha Inicio</label>
                  </div>
                  <div class="input-field col s12 m2">
                    <input type="text" class="validate" pattern="(\d{4})(-)([0][1-9]|[1][0-2])\2([0][1-9]|[12][0-9]|3[01])" name="oeuvre_completionDate" value="<?= date("Y-m-d"); ?>" required >
                    <label class="col s12 no-padding" for="oeuvre_completionDate" data-error="Introduzca una fecha con formato AAAA-MM-DD" >Fecha Finalización</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6 offset-m3 center">
                    <button class="btn waves-effect waves-light center" type="submit" autocomplete="off">Añadir obra
                      <i class="material-icons right">add</i>
                    </button>
                  </div>
                </div>
            </form>
        </section>
    </div>

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
                      <th>Empleado</th>
                      <th>Nombre Contacto</th>
                      <th>Latitud</th>
                      <th>Longitud</th>
                      <th>Fecha Inicio</th>
                      <th>Fecha Finalización</th>
                      <th>EDITAR</th>
                      <th>ELIMINAR</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($this->oeuvres as $key => $value) { ?>
                    <tr>
                      <td><?= $value->oeuvre_id; ?></td>
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
                          if($content->user_id == $value->supervisor_id) {?>
                          <td><?= htmlentities($content->user_name); ?></td>
                          <?php }?>
                      <?php }?>
                      <td><?= htmlentities($value->oeuvre_contact_name); ?></td>
                      <td><?= htmlentities($value->oeuvre_latitud); ?></td>
                      <td><?= htmlentities($value->oeuvre_longitud); ?></td>
                      <td><?= htmlentities($value->oeuvre_startDate); ?></td>
                      <td><?= htmlentities($value->oeuvre_completionDate); ?></td>
                      <td><a class="btn-floating btn-large" href="<?= Config::get('URL') . 'oeuvre/edit/' . $value->oeuvre_id; ?>"><i class="large material-icons">mode_edit</i></a></td>
                      <td><a class="btn-floating btn-large" href="<?= Config::get('URL') . 'oeuvre/delete/' . $value->oeuvre_id; ?>"><i class="large material-icons">clear</i></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <div>No hay ningún obra aún. Créate alguna!</div>
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
