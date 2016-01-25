<main class="container">
  <div class="row">
    <div class="col s12 center">
        <h2>TU CUENTA</h2>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <div class="row">
          <div class="col s6">
            <h3>Tu perfil público</h3>
            <table class="responsive-table bordered striped">
              <tr>
                <th>Tu Nick:</th><td><?= $this->user_name; ?></td>
                <td><a class="btn-floating btn-large" href="<?php echo Config::get('URL'); ?>user/editusername"><i class="large material-icons">mode_edit</i></a></td>
              </tr>
              <tr>
                <th>Tu email:</th><td> <?= $this->user_email; ?></td>
                <td><a class="btn-floating btn-large" href="<?php echo Config::get('URL'); ?>user/edituseremail"><i class="large material-icons">mode_edit</i></a></td>

              </tr>
              <tr class="valign">
                <th>Tu imagen de Avatar:
                    <?php if (Config::get('USE_GRAVATAR')) { ?>
                        (en gravatar.com):</th>
                <td> <img src='<?= $this->user_gravatar_image_url; ?>' />
                    <?php } else { ?>
                        (guardado localmente):</th>
                <td> <img src='<?= $this->user_avatar_file; ?>' />
                    <?php } ?>
                </td>
                <td><a class="btn-floating btn-large" href="<?php echo Config::get('URL'); ?>user/editAvatar"><i class="large material-icons">mode_edit</i></a></td>
              </tr>
              <tr>
                <th>Tu tipo de cuenta es:</th><td><?php if ($this->user_account_type == 7) : ?> Administrador <?php elseif($this->user_account_type == 4) : ?> Empleado <?php else: ?> Normal <?php endif ?></td>
              </tr>
            </table>
          </div>
          <div class="col s6">
            <h3>Tus datos privados</h3>
            <table class="responsive-table bordered striped">
              <tr>
                <th>Tu nombre:</th><td><?= $this->userPrivateData->name; ?></td>
              </tr>
              <tr>
                <th>Tu primer apellido:</th><td> <?= $this->userPrivateData->user_surname1; ?></td>
              </tr>
              <tr>
                <th>Tu segundo apellido:</th><td> <?= $this->userPrivateData->user_surname2; ?></td>
              </tr>
              <tr>
                <th>Tu dirección:</th><td> <?= $this->userPrivateData->user_address; ?></td>
              </tr>
              <tr>
                <th>Tu población:</th><td> <?= $this->userPrivateData->user_city; ?></td>
              </tr>
              <tr>
                <th>Tu provincia:</th><td> <?= $this->userPrivateData->user_province; ?></td>
              </tr>
              <tr>
                <th>Tu NIF:</th><td> <?= $this->userPrivateData->user_NIF; ?></td>
              </tr>
              <tr>
                <th>Tu nº teléfono:</th><td> <?= $this->userPrivateData->user_phone; ?></td>
              </tr>
              <?php if($this->user_account_type == 4){ ?>
                  <tr>
                    <th>Tu fecha contratación:</th><td> <?= $this->userPrivateData->user_contract_date; ?></td>
                  </tr>
              <?php } ?>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col s6">
            <a class="btn waves-effect waves-light center" href="<?php echo Config::get('URL'); ?>user/changePassword">Cambiar contraseña</a>
          </div>
          <div class="col s6">
            <a class="btn waves-effect waves-light center" href="<?php echo Config::get('URL') . 'user/editPrivateData/' . $this->user_name; ?>">Editar datos privados</a>
          </div>
        </div>
    </div>
  </div>
</main>
