<main class="container">
    <div class="row">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <section class="col s12" >
            <h1 class="center">Tus locales</h1>
            <form method="post" action="<?php echo Config::get('URL');?>local/create">
                <div class="row">
                  <div class="input-field col s12 m6 offset-m3">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="local_name" placeholder="Nombre (letras 2-64 caracteres)" required autofocus>
                    <label class="col s12 no-padding" for="local_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Introduce nombre del local</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s,]{2,64}" name="local_address" id="address" placeholder="Domicilio (letras/numeros, 2-64 caracteres)" required >
                    <label class="col s12 no-padding" for="local_address" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Domicilio</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[0-9A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="local_city_id" id="city" placeholder="Poblacion (letras 2-64 caracteres)" required >
                    <label class="col s12 no-padding" for="local_city_id" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Población</label>
                  </div>
                  <div class="input-field col s12 m4 ">
                    <input type="button" class="btn waves-effect waves-light center" id="search" value="Situar en el mapa" />
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="^(\+34\s?)([9|6][0-9]{8})$|^([9|6][0-9]{8})$" name="local_phone" placeholder="Telefono de contacto (+34923456789 +34 923456789 923456789 +34 623456789 623456789)" required >
                    <label class="col s12 no-padding" for="local_phone" data-error="incorrecto" >Teléfono</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="email" class="validate" name="local_email" placeholder="Dirección email (una dirección real)" required >
                    <label class="col s12 no-padding" for="local_email" data-error="No se ajusta al patrón de un email" >Dirección email</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="local_contact_name" placeholder="Nombre (letras 2-64 caracteres)" required >
                    <label class="col s12 no-padding" for="local_contact_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Introduce nombre de persona de contacto</label>
                  </div>
                </div>
                <div class="row">
                    <div class="col s12" id="map_canvas" style="height: 350px"></div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="local_latitud" id="latitude" placeholder="Latitud" >
                    <label class="col s12 no-padding" for="local_latitud" data-error="incorrecto: numeros decimales (use un punto)" >Latitud</label>
                  </div>
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="local_longitud" id="longitude" placeholder="Longitud" >
                    <label class="col s12 no-padding" for="local_longitud" data-error="incorrecto: numeros decimales (use un punto)" >Longitud</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6 offset-m3 center">
                    <button class="btn waves-effect waves-light center" type="submit" autocomplete="off">Añadir local
                      <i class="material-icons right">add</i>
                    </button>
                  </div>
                </div>
            </form>
        </section>
    </div>

    <div class="row">
        <section class="col s12 center" >
        <?php if ($this->locals) { ?>
            <table class="responsive-table bordered striped centered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Domicilio</th>
                    <th>Poblacion</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Nombre Contacto</th>
                    <th>Latitud</th>
                    <th>Longitud</th>
                    <th>EDITAR</th>
                    <th>ELIMINAR</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($this->locals as $key => $value) { ?>
                        <tr>
                            <td><?= $value->local_id; ?></td>
                            <td><?= htmlentities($value->local_name); ?></td>
                            <td><?= htmlentities($value->local_address); ?></td>
                            <td><?= htmlentities($value->local_city_id); ?></td>
                            <td><?= htmlentities($value->local_phone); ?></td>
                            <td><?= htmlentities($value->local_email); ?></td>
                            <td><?= htmlentities($value->local_contact_name); ?></td>
                            <td><?= htmlentities($value->local_latitud); ?></td>
                            <td><?= htmlentities($value->local_longitud); ?></td>
                            <td><a class="btn-floating btn-large" href="<?= Config::get('URL') . 'local/edit/' . $value->local_id; ?>"><i class="large material-icons">mode_edit</i></a></td>
                            <td><a class="btn-floating btn-large" href="<?= Config::get('URL') . 'local/delete/' . $value->local_id; ?>"><i class="large material-icons">clear</i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <div>No hay ningún local aún. Créate alguno!</div>
            <?php } ?>
        </section>
    </div>
</main>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript">

  var map = null;
  var marker = null;

  function load_map() {
      var trebujena = new google.maps.LatLng(36.870781, -6.174377100000015);
      var myOptions = {
          zoom: 15,
          center: trebujena,
          mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      map = new google.maps.Map($("#map_canvas").get(0), myOptions);
  }

  $('body').on('click', '#search', function() {
      // Obtenemos la dirección y la asignamos a una variable
      var address = $('#address').val();
      var city = $('#city').val();
      var addressComplete = address + ", " + city;
      // Creamos el Objeto Geocoder
      var geocoder = new google.maps.Geocoder();
      // Hacemos la petición indicando la dirección e invocamos la función
      // geocodeResult enviando todo el resultado obtenido
      geocoder.geocode({ 'address': addressComplete}, geocodeResult);
  });

  function geocodeResult(results, status) {
      // Verificamos el estatus
      if (status == 'OK') {
          // Si hay resultados encontrados, centramos y repintamos el mapa
          // esto para eliminar cualquier pin antes puesto
          var mapOptions = {
              center: results[0].geometry.location,
              mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          map = new google.maps.Map($("#map_canvas").get(0), mapOptions);
          //rellenamos las cajas de texto de las coordenadas
          $('#latitude').val(results[0].geometry.location.lat());
          $('#longitude').val(results[0].geometry.location.lng());
          // fitBounds acercará el mapa con el zoom adecuado de acuerdo a lo buscado
          map.fitBounds(results[0].geometry.viewport);
          // Dibujamos un marcador con la ubicación del primer resultado obtenido
          var markerOptions = { position: results[0].geometry.location }
          var marker = new google.maps.Marker(markerOptions);
          marker.setMap(map);
      } else {
          // En caso de no haber resultados o que haya ocurrido un error
          // lanzamos un mensaje con el error
          alert("Geocoding no tuvo éxito debido a: " + status);
      }
  }
  $(document).ready(function() {
    load_map();
  });

</script>
