<main class="container">
  <div class="row">
    <div class="col s12 center">
        <h2>Tu perfil</h2>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <div class="row">
          <div class="col s6">
            <table class="responsive-table">
              <tr>
                <th>Tu Nick:</th><td><?= $this->user_name; ?></td>
              </tr>
              <tr>
                <th>Tu email:</th><td> <?= $this->user_email; ?></td>
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
              </tr>
              <tr>
                <th>Tu tipo de cuenta es:</th><td> <?= $this->user_account_type; ?></td>
              </tr>
            </table>
          </div>
        </div>
    </div>
  </div>
</main>
