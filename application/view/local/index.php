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
                    <input type="text" class="validate" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s,]{2,64}" name="local_address" placeholder="Domicilio (letras/numeros, 2-64 caracteres)" required >
                    <label class="col s12 no-padding" for="local_address" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Domicilio</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="[0-9A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="local_city_id" placeholder="Poblacion (letras 2-64 caracteres)" required >
                    <label class="col s12 no-padding" for="local_city_id" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Población</label>
                  </div>
                  <div class="input-field col s12 m4">
                    <input type="text" class="validate" pattern="^(\+34\s?)([9|6][0-9]{8})$|^([9|6][0-9]{8})$" name="local_phone" placeholder="Telefono de contacto (+34923456789 +34 923456789 923456789 +34 623456789 623456789)" required >
                    <label class="col s12 no-padding" for="local_phone" data-error="incorrecto" >Teléfono</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6">
                    <input type="email" class="validate" name="local_email" placeholder="Dirección email (una dirección real)" required >
                    <label class="col s12 no-padding" for="local_email" data-error="No se ajusta al patrón de un email" >Dirección email</label>
                  </div>
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,64}" name="local_contact_name" placeholder="Nombre (letras 2-64 caracteres)" required >
                    <label class="col s12 no-padding" for="local_contact_name" data-error="Introduzca letras (entre 2 y 64 caracteres)" >Introduce nombre de persona de contacto</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="local_latitud" >
                    <label class="col s12 no-padding" for="local_latitud" data-error="incorrecto: numeros decimales (use un punto)" >Latitud</label>
                  </div>
                  <div class="input-field col s12 m6">
                    <input type="text" class="validate" pattern="(\+?|-)[0-9]{0,13}\.[0-9]{1,10}" name="local_longitud" >
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
                    <td class="center">Id</td>
                    <td class="center">Nombre</td>
                    <td class="center">Domicilio</td>
                    <td class="center">Poblacion</td>
                    <td class="center">Telefono</td>
                    <td class="center">Email</td>
                    <td class="center">Nombre Contacto</td>
                    <td class="center">Latitud</td>
                    <td class="center">Longitud</td>
                    <td class="center">EDITAR</td>
                    <td class="center">ELIMINAR</td>
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
