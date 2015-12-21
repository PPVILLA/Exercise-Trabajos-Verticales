<!doctype html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Trabajos Verticales Reparacion fachada</title>
    <meta name="description" content="una empresa con dilatada experiencia en  el sector de trabajos en altura en la provincia de Cádiz. Nuestros servicios están dirigidos a toda clase de actividad en lugares de difícil acceso mediante técnicas de escalada aplicadas a la edificación e industria, sin utilizar andamios ni grúas.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="apple-touch-icon" href="apple-touch-icon.png"> -->
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo Config::get('URL');?>favicon.ico">

    <!-- send empty favicon fallback to prevent user's browser hitting the server for lots of favicon requests resulting in 404s -->
    <!-- <link rel="icon" href=""> -->

    <!-- PHPHUGE CSS -->
    <!-- <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" /> -->
    <!-- html5-boilerplate CSS
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css"> -->

    <!-- Bootstrap core CSS -->
    <link href="<?php echo Config::get('URL');?>css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template
    <link href="jumbotron.css" rel="stylesheet"> -->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo Config::get('URL'); ?>js/ie-emulation-modes-warning.js"></script>
    <script src="<?php echo Config::get('URL'); ?>js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
    <!-- wrapper, to center website -->
    <!-- <div class="wrapper"> -->

        <!-- logo -->
        <!-- <div class="logo"></div> -->
    <!-- navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo Config::get('URL'); ?>">ADV Trabajos Verticales</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li <?php if (View::checkForActiveController($filename, "index")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>">Página principal</a>
                    </li>
                    <!-- <li <?php if (View::checkForActiveController($filename, "profile")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>profile/index">Perfiles</a>
                    </li> -->
                    <?php if (Session::userIsLoggedIn()) { ?>
                        <li <?php if (View::checkForActiveController($filename, "dashboard")) { echo ' class="active" '; } ?> >
                            <a href="<?php echo Config::get('URL'); ?>dashboard/index">Panel Usuario</a>
                        </li>
                        <li <?php if (View::checkForActiveController($filename, "note")) { echo ' class="active" '; } ?> >
                            <a href="<?php echo Config::get('URL'); ?>note/index">Mis notas</a>
                        </li>
                    <?php } else { ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                        <!-- for not logged in users -->
                        <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
                            <a href="<?php echo Config::get('URL'); ?>login/index">Login</a>
                        </li>
                        <li <?php if (View::checkForActiveControllerAndAction($filename, "login/register")) { echo ' class="active" '; } ?> >
                            <a href="<?php echo Config::get('URL'); ?>login/register">Registrate</a>
                        </li>
                    <?php } ?>
                </ul>

                <!-- my account -->
                <ul class="nav navbar-nav navbar-right">
                <?php if (Session::userIsLoggedIn()) : ?>
                    <li class="dropdown" <?php if (View::checkForActiveController($filename, "login")) { echo ' class="dropdown" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>login/showprofile" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mi cuenta <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                                <a href="<?php echo Config::get('URL'); ?>login/changeUserRole">Cambiar tipo de cuenta</a>
                            </li>
                            <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                                <a href="<?php echo Config::get('URL'); ?>login/editAvatar">Editar tu avatar</a>
                            </li>
                            <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                                <a href="<?php echo Config::get('URL'); ?>login/editusername">Editar mi nick</a>
                            </li>
                            <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                                <a href="<?php echo Config::get('URL'); ?>login/edituseremail">Editar mi email</a>
                            </li>
                            <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                                <a href="<?php echo Config::get('URL'); ?>login/changePassword">Cambiar contraseña</a>
                            </li>
                            <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                                <a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
                            </li>
                        </ul>
                    </li>
                    <?php if (Session::get("user_account_type") == 7) : ?>
                        <li <?php if (View::checkForActiveController($filename, "admin")) {
                            echo ' class="active" ';
                        } ?> >
                            <a href="<?php echo Config::get('URL'); ?>admin/">Administrador</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                </ul>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>
