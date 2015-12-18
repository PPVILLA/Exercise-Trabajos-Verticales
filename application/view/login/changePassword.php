<div class="container">
    <h1>LoginController/changePassword</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="box">
        <h2>Establecer nueva contraseña</h2>

        <!-- new password form box -->
        <form method="post" action="<?php echo Config::get('URL'); ?>login/changePassword_action" name="new_password_form">
            <label for="change_input_password_current">Introduce la contraseña actual:</label>
            <p><input id="change_input_password_current" class="reset_input" type='password'
                   name='user_password_current' pattern=".{6,}" required autocomplete="off"  /></p>
            <label for="change_input_password_new">Nueva contraseña (min. 6 caracteres)</label>
            <p><input id="change_input_password_new" class="reset_input" type="password"
                   name="user_password_new" pattern=".{6,}" required autocomplete="off" /></p>
            <label for="change_input_password_repeat">Repite nueva contraseña</label>
            <p><input id="change_input_password_repeat" class="reset_input" type="password"
                   name="user_password_repeat" pattern=".{6,}" required autocomplete="off" /></p>
            <input type="submit"  name="submit_new_password" value="Submit new password" />
        </form>

    </div>
</div>
