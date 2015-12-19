<div class="container">
    <h1>LoginController/editUserEmail</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="box">
        <h2>Cambia tu dirección email</h2>

        <form action="<?php echo Config::get('URL'); ?>login/editUserEmail_action" method="post">
            <label>
                Nueva dirección email: <input type="text" name="user_email" required />
            </label>
            <input type="submit" value="Enviar" />
        </form>
    </div>
</div>
