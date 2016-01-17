<main class="container">

    <div class="row">
      <div class="col s12">

          <h2 class="center">Cambiar el tipo de cuenta</h2>
          <!-- echo out the system feedback (error and success messages) -->
          <?php $this->renderFeedbackMessages(); ?>
          <p>
              Esta página es una implementación básica del proceso de actualización. El usuario puede hacer clic en ese botón para actualizar sus cuentas de "cuenta básica" a "cuenta premium". Este sencillo script ofrece un botón del ratón capaz que actualizar / degradar la cuenta al instante. En una aplicación real que le implementar algo así como un proceso de pago.
          </p>
        <h3 class="center">Actualmente tu tipo de cuenta es: <?php echo Session::get('user_account_type'); ?></h3>
          <!-- basic implementation for two account types: type 1 and type 2 -->
        <form class="center"action="<?php echo Config::get('URL'); ?>user/changeUserRole_action" method="post">
            <?php if (Session::get('user_account_type') == 1) { ?>
                  <input class="btn waves-effect waves-light center" type="submit" name="user_account_upgrade" value="Mejorar mi cuenta (a usuario Premium)" />
            <?php } else if (Session::get('user_account_type') == 2) { ?>
                <input class="btn waves-effect waves-light center" type="submit" name="user_account_downgrade" value="Rebajar mi cuenta (a usuario Básico)" />
            <?php } ?>
        </form>
      </div>
    </div>
</main>
