<div class="container">
    <h1>LoginController/changeUserRole</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="box">
        <h2>Cambiar el tipo de cuenta</h2>
        <p>
            Esta página es una implementación básica del proceso de actualización. El usuario puede hacer clic en ese botón para actualizar sus cuentas de "cuenta básica" a "cuenta premium". Este sencillo script ofrece un botón del ratón capaz que actualizar / degradar la cuenta al instante. En una aplicación real que le implementar algo así como un proceso de pago.
        </p>
	    <!-- <p>
		    Nota: Todo este proceso se ha renombrado de AccountType (v3.0) a UserRole (v3.1).
	    </p> -->

        <h2>Actualmente tu tipo de cuenta es: <?php echo Session::get('user_account_type'); ?></h2>
        <!-- basic implementation for two account types: type 1 and type 2 -->
	    <form action="<?php echo Config::get('URL'); ?>login/changeUserRole_action" method="post">
            <?php if (Session::get('user_account_type') == 1) { ?>
                <input type="submit" name="user_account_upgrade" value="Mejorar mi cuenta (a usuario Premium)" />
	        <?php } else if (Session::get('user_account_type') == 2) { ?>
	            <input type="submit" name="user_account_downgrade" value="Rebajar mi cuenta (a usuario Básico)" />
	        <?php } ?>
	    </form>
    </div>
</div>
