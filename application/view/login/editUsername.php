<main class="container">
    <h1>LoginController/editUsername</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="container">
        <h2>Cambia tu nick (nombre de usuario)</h2>

        <form action="<?php echo Config::get('URL'); ?>login/editUserName_action" method="post">
            <!-- btw http://stackoverflow.com/questions/774054/should-i-put-input-tag-inside-label-tag -->
            <label>
                Nuevo nick (o nombre de usuario): <input type="text" name="user_name" required />
            </label>
			<!-- set CSRF token at the end of the form -->
			<input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>" />
            <input type="submit" value="Enviar" />
        </form>
    </div>
</main>
