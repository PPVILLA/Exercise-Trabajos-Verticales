<div class="container">
    <h1>LoginController/showProfile</h1>

    <div class="box">
        <h2>Tu perfil</h2>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <div>Tu Nick: <?= $this->user_name; ?></div>
        <div>Tu email: <?= $this->user_email; ?></div>
        <div>Tu imagen de Avatar:
            <?php if (Config::get('USE_GRAVATAR')) { ?>
                Tu imagen de gravatar (en gravatar.com): <img src='<?= $this->user_gravatar_image_url; ?>' />
            <?php } else { ?>
                Tu imagen avatar (guardado localmente): <img src='<?= $this->user_avatar_file; ?>' />
            <?php } ?>
        </div>
        <div>Tu tipo de cuenta es: <?= $this->user_account_type; ?></div>
    </div>
</div>
