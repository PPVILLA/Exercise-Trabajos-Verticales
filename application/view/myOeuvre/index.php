<main class="row" style="margin: 0 5%;">
  <h1 class="center">Mi obra</h1>

  <!-- echo out the system feedback (error and success messages) -->
  <?php $this->renderFeedbackMessages(); ?>
  <h3 class="red lighten-2 white-text center">TUS FOTOS DE OBRA:</h3>
  <div class="row">
    <section class="col s12" >
      <?php if ($this->myPhotoOeuvre) { ?>
        <table class="responsive-table bordered striped centered">
            <thead>
            <tr>
                <th>Foto</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($this->myPhotoOeuvre as $key => $value) {  ?>
                    <tr>
                        <td><?php if (isset($value->oeuvrePhoto_photoOeuvre_link)) { ?>
                                <img src="<?= $value->oeuvrePhoto_photoOeuvre_link; ?>" />
                            <?php } ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
        <div>No hay ninguna foto realizada para tu obra aún.</div>
        <?php } ?>
    </section>
  </div>

</main>
