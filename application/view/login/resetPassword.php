<main class="container">
    <h1>LoginController/resetPassword</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="container">
        <h2>Establecer nueva contraseña</h2>

        <!-- <p>FYI: ... el proceso de identificación funciona a través de password-reset-token (campo de entrada oculto)</p> -->

        <!-- new password form box -->
        <form method="post" action="<?php echo Config::get('URL'); ?>login/setNewPassword" name="new_password_form">
            <input type='hidden' name='user_name' value='<?php echo $this->user_name; ?>' />
            <input type='hidden' name='user_password_reset_hash' value='<?php echo $this->user_password_reset_hash; ?>' />
            <label for="reset_input_password_new">Nueva contraseña (min. 6 caracteres)</label>
            <input id="reset_input_password_new" class="reset_input" type="password"
                   name="user_password_new" pattern=".{6,}" required autocomplete="off" />
            <label for="reset_input_password_repeat">Repite nueva contraseña</label>
            <input id="reset_input_password_repeat" class="reset_input" type="password"
                   name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
            <input type="submit"  name="submit_new_password" value="Envia nueva contraseña" />
        </form>

        <a href="<?php echo Config::get('URL'); ?>login/index">Volver a pagina de Login</a>
    </div>
</main>
