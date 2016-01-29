<main class="container">
    <div class="row">
        <h1 class="center">Edita una nota</h1>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <section class="col s12 center" >

        <?php if ($this->note) { ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>note/editSave">
                <div class="row">
                  <div class="input-field col s12">
                    <label>Cambia texto de nota: </label>
                    <!-- we use htmlentities() here to prevent user input with " etc. break the HTML -->
                    <input type="hidden" name="note_id" value="<?php echo htmlentities($this->note->note_id); ?>" />
                    <input type="text" name="note_text" value="<?php echo htmlentities($this->note->note_text); ?>" />
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <button class="btn waves-effect waves-light center" type="submit" autocomplete="off">Cambia
                      <i class="material-icons right">send</i>
                    </button>
                  </div>
                </div>
            </form>
        <?php } else { ?>
            <p>Esta nota no existe.</p>
        <?php } ?>
    </div>
</main>
