<div class="container">
    <h1>DashboardController/index</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3>¿Qué sucede aquí?</h3>
        <p>
            This is an area that's only visible for logged in users. Try to log out, an go to /dashboard/ again. You'll
            be redirected to /index/ as you are not logged in. You can protect a whole section in your app within the
            according controller by placing <i>Auth::handleLogin();</i> into the constructor.
            Esta es un área que es accesibles solamente para los usuarios registrados. Trate de salir, ir a un / dashboard / nuevo. . Se le redirige a / index / ya que no está en el sistema Usted puede proteger toda una sección en su aplicación dentro del controlador de acuerdo mediante la colocación de <i> de Auth :: handleLogin (); </ i> en el constructor.
        <p>
    </div>
</div>
