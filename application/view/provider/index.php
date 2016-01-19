<main class="container">
    <div class="row">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <section class="col s12" >
            <h1 class="center">Tus proveedores</h1>
            <form method="post" action="<?php echo Config::get('URL');?>provider/create">
                <div class="row">
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="^[A-Z][0-9]{8,8}$" name="provider_CIF" placeholder="CIF (1 letra Mayuscula y 8 digitos)" required autofocus>
                    <label class="col s12 no-padding" for="provider_CIF" data-error="Introduzca 1 letra Mayuscula y 8 digitos" >C.I.F.</label>
                  </div>
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="provider_name" placeholder="Nombre (letras 2-64 caracteres)" required autofocus>
                    <label class="col s12 no-padding" for="provider_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Introduce nombre del proveedor</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s,]{2,64}" name="provider_address" placeholder="Domicilio (letras/numeros, 2-64 caracteres)" required >
                    <label class="col s12 no-padding" for="provider_address" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Domicilio</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[0-9A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="provider_city_id" placeholder="Poblacion (letras 2-64 caracteres)" required >
                    <label class="col s12 no-padding" for="provider_city_id" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Población</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="^(\+34\s?)([9|6][0-9]{8})$|^([9|6][0-9]{8})$" name="provider_phone" placeholder="Telefono de contacto (+34923456789 +34 923456789 923456789 +34 623456789 623456789)" required >
                    <label class="col s12 no-padding" for="provider_phone" data-error="incorrecto" >Teléfono</label>
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
                      <td class="center">Id</td>
                      <td class="center">CIF</td>
                      <td class="center">Nombre</td>
                      <td class="center">Domicilio</td>
                      <td class="center">Poblacion</td>
                      <td class="center">Telefono</td>
                      <td class="center">Email</td>
                      <td class="center">Direccion Web</td>
                      <td class="center">Nombre Contacto</td>
                      <td class="center">Latitud</td>
                      <td class="center">Longitud</td>
                      <td class="center">EDITAR</td>
                      <td class="center">ELIMINAR</td>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($this->providers as $key => $value) { ?>
                    <tr>
                      <td><?= $value->provider_id; ?></td>
                      <td><?= htmlentities($value->provider_CIF); ?></td>
                      <td><?= htmlentities($value->provider_name); ?></td>
                      <td><?= htmlentities($value->provider_address); ?></td>
                      <td><?= htmlentities($value->provider_city_id); ?></td>
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
