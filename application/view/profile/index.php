<main class="container">
    <h1>ProfileController/index</h1>
    <div class="container">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3>¿Qué sucede aquí?</h3>
        <div>
            Este "controlador/acción/vista" muestra una lista de todos los usuarios del sistema. Usted puede utilizar el código subyacente para construir cosas que utilizan la información de perfil de una o múltiple/todos los usuarios.
        </div>
        <div>
            <table class="responsive-table bordered striped centered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Avatar</th>
                    <th>Nick</th>
                    <th>email de usuarios</th>
                    <th>Activado ?</th>
                    <th>Link al perfil de usuarios</th>
                </tr>
                </thead>
                <?php foreach ($this->users as $user) { ?>
                    <tr class="<?= ($user->user_active == 0 ? 'inactive' : 'active'); ?>">
                        <td><?= $user->user_id; ?></td>
                        <td class="avatar">
                            <?php if (isset($user->user_avatar_link)) { ?>
                                <img src="<?= $user->user_avatar_link; ?>" />
                            <?php } ?>
                        </td>
                        <td><?= $user->user_name; ?></td>
                        <td><?= $user->user_email; ?></td>
                        <td><?= ($user->user_active == 0 ? 'No' : 'Si'); ?></td>
                        <td>
                            <a href="<?= Config::get('URL') . 'profile/showProfile/' . $user->user_id; ?>">Perfil</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</main>
