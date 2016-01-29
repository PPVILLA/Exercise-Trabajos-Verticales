<main class="row" style="margin: 0 5%;">
    <h1 class="center">Panel de gestion de usuarios</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="row">

            <table class="col s12 responsive-table bordered striped centered">
                <thead>
                  <tr>
                      <th>Id</th>
                      <th>Avatar</th>
                      <th>Nick</th>
                      <th>email de usuarios</th>
                      <th>tipo de cuenta</th>
                      <th>Fecha contratacion</th>
                      <th>¿Activado?</th>
                      <th>Intentos fallidos de Login</th>
                      <th>Link al perfil de usuario</th>
                      <th>Dias de suspensión</th>
                      <th>Borrado logico</th>
                      <th>¿Resetear intentos de Login y activar usuario?</th>
                      <th>Enviar</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i = 0 ?>
                <?php foreach ($this->users as $user) { $i++; ?>
                    <tr class="<?= ($user->user_active == 0 ? 'inactive' : 'active'); ?>">
                        <td><?= $user->user_id; ?></td>
                        <td class="avatar">
                            <?php if (isset($user->user_avatar_link)) { ?>
                                <img src="<?= $user->user_avatar_link; ?>"/>
                            <?php } ?>
                        </td>
                        <td><?= $user->user_name; ?></td>
                        <td><?= $user->user_email; ?></td>
                        <td><?php if ($user->user_account_type == 7) : ?> Administrador <?php elseif($user->user_account_type == 4) : ?> Empleado <?php else: ?> Normal <?php endif ?></td>
                        <td><?= $user->user_contract_date; ?></td>
                        <td><?= ($user->user_active == 0 ? 'No' : 'Si'); ?></td>
                        <td><?= $user->user_failed_logins; ?></td>
                        <td>
                            <a href="<?= Config::get('URL') . 'profile/showProfile/' . $user->user_id; ?>">Perfil</a>
                        </td>
                        <form action="<?= config::get("URL"); ?>admin/actionAccountSettings" method="post">
                            <td class="input-field"><input type="number" name="suspension" /></td>
                            <td>
                              <input type="checkbox" id="softDelete<?= $i ?>" name="softDelete" <?php if ($user->user_deleted) { ?> checked <?php } ?> />
                              <label for="softDelete<?= $i ?>"></label>
                            </td>
                            <td>
                              <input type="checkbox" id="resetUser<?= $i ?>" name="resetUser" />
                              <label for="resetUser<?= $i ?>"></label>
                            </td>
                            <td>
                                <input type="hidden" name="user_id" value="<?= $user->user_id; ?>" />
                                <button class="btn-floating btn-large" type="submit">
                                  <i class="material-icons right">send</i>
                                </button>
                            </td>
                        </form>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

    </div>
</main>
