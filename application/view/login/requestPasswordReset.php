<div class="container">
    <h1>Solicite un restablecimiento de contraseña</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <!-- request password reset form box -->
        <form method="post" action="<?php echo Config::get('URL'); ?>login/requestPasswordReset_action">
            <label>
                Introduzca su nombre de usuario o correo electrónico y recibirás un correo con instrucciones:
                <input type="text" name="user_name_or_email" required />
            </label>
            <input type="submit" value="Send me a password-reset mail" />
        </form>

    </div>
</div>
