<main class="container">
    <h1>ProfileController/showProfile/:id</h1>
    <div class="container">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3>¿Qué sucede aquí?</h3>
        <div>Este controlador/acción/vista muestra toda la información pública acerca de un determinado usuario.</div>

        <?php if ($this->user) { ?>
            <div>
                <table class="responsive-table bordered striped centered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Avatar</th>
                        <th>Nick</th>
                        <th>Email de los usuarios</th>
                        <th>¿Activado?</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="<?= ($this->user->user_active == 0 ? 'inactive' : 'active'); ?>">
                            <td><?= $this->user->user_id; ?></td>
                            <td class="avatar">
                                <?php if (isset($this->user->user_avatar_link)) { ?>
                                    <img src="<?= $this->user->user_avatar_link; ?>" />
                                <?php } ?>
                            </td>
                            <td><?= $this->user->user_name; ?></td>
                            <td><?= $this->user->user_email; ?></td>
                            <td><?= ($this->user->user_active == 0 ? 'No' : 'Si'); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php } ?>

    </div>
</main>
