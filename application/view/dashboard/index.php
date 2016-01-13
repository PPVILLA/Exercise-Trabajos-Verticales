<main class="container">
    <h1>DashboardController/index</h1>
    <div class="container">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3>¿Qué sucede aquí?</h3>
        <p>
            Esta es un área que es accesible solamente para los usuarios registrados. Trate de cerrar sesión, y vaya al /dashboard/ de nuevo. Será redirigido a /index/ si no está registrado en el sistema. Usted puede proteger una sección completa en su aplicación dentro del controlador conforme vaya colocando <i>Auth::handleLogin();</i> en el constructor.
        <p>
    </div>
</main>
