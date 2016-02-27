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
    <!--<link href="<?php echo Config::get('URL');?>css/bootstrap.css" rel="stylesheet"> -->
    <!-- Custom styles for this template
    <link href="jumbotron.css" rel="stylesheet"> -->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!--<script src="<?php echo Config::get('URL'); ?>js/ie-emulation-modes-warning.js"></script>
    <script src="<?php echo Config::get('URL'); ?>js/vendor/modernizr-2.8.3.min.js"></script>-->

    <!--Import Google Icon Font -->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/customMaterialize.min.css"  media="screen,projection"/>

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
    <!-- DropdownAdmin Structure -->
    <ul id="dropdownAdmin" class="dropdown-content">
      <li <?php if (View::checkForActiveController($filename, "profile")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>profile/index">Gestion de Perfiles</a>
      </li>
      <li <?php if (View::checkForActiveController($filename, "admin")) { echo ' class="active" ';  } ?> >
          <a href="<?php echo Config::get('URL'); ?>admin/">Gestion de Usuarios</a>
      </li>
      <li <?php if (View::checkForActiveController($filename, "employee")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>employee/index">Gestion de empleados</a>
      </li>
      <li <?php if (View::checkForActiveController($filename, "oeuvre")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>oeuvre/index">Gestion de obras</a>
      </li>
      <li <?php if (View::checkForActiveController($filename, "provider")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>provider/index">Gestion de proveedores</a>
      </li>
      <li <?php if (View::checkForActiveController($filename, "material")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>material/index/0">Gestion de materiales</a>
      </li>
      <li <?php if (View::checkForActiveController($filename, "local")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>local/index">Gestion de locales</a>
      </li>
    </ul><!--/.dropdown-content -->
    <!-- DropdownAdmin SideNav Structure -->
    <ul id="dropdownAdminSideNav" class="dropdown-content">
      <li <?php if (View::checkForActiveController($filename, "profile")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>profile/index">Gestion de Perfiles</a>
      </li>
      <li <?php if (View::checkForActiveController($filename, "admin")) { echo ' class="active" ';  } ?> >
          <a href="<?php echo Config::get('URL'); ?>admin/">Gestion de Usuarios</a>
      </li>
      <li <?php if (View::checkForActiveController($filename, "employee")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>employee/index">Gestion de empleados</a>
      </li>
      <li <?php if (View::checkForActiveController($filename, "oeuvre")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>oeuvre/index">Gestion de obras</a>
      </li>
      <li <?php if (View::checkForActiveController($filename, "provider")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>provider/index">Gestion de proveedores</a>
      </li>
      <li <?php if (View::checkForActiveController($filename, "material")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>material/index/0">Gestion de materiales</a>
      </li>
      <li <?php if (View::checkForActiveController($filename, "local")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>local/index">Gestion de locales</a>
      </li>
    </ul><!--/.dropdown-content -->
    <!-- navigation -->
    <div class="navbar-fixed">
      <nav>
        <div class="nav-wrapper">
          <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
          <a class="brand-logo center" href="<?php echo Config::get('URL'); ?>"><img class="navbar-fixed" src="<?php echo Config::get('URL'); ?>img/adv-trabajos-verticales-cadiz.jpg" alt="ADV Trabajos Verticales Cadiz"></a>

          <ul class="left hide-on-med-and-down">
            <li <?php if (View::checkForActiveController($filename, "index")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>">Página principal</a>
            </li>
            <?php if (Session::userIsLoggedIn()) { ?>
              <?php if (Session::get("user_account_type") == 4) : ?>
                <li <?php if (View::checkForActiveController($filename, "dashboard")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo Config::get('URL'); ?>dashboard/index">Panel Trabajador</a>
                </li>
                <li <?php if (View::checkForActiveController($filename, "note")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo Config::get('URL'); ?>note/index">Mis Anotaciones</a>
                </li>
              <?php endif; ?>
            <?php } else { ?>
          </ul><!--/.left hide-on-med-and-down-->
          <ul class="right hide-on-med-and-down">
            <!-- for not logged in users -->
            <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>login/index">Login</a>
            </li>
            <li <?php if (View::checkForActiveControllerAndAction($filename, "register/index")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>register/index">Registrate</a>
            </li>
            <?php } ?>
          </ul><!--/.right hide-on-med-and-down-->

          <?php if (Session::userIsLoggedIn()) : ?>
          <!-- my account -->
          <ul class="right hide-on-med-and-down">
            <li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>user/index">Mi perfil</a>
            </li>
            <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
            </li>
            <?php if (Session::get("user_account_type") == 7) : ?>
              <li <?php if (View::checkForActiveController($filename, "admin")) { echo ' class="active" ';  } ?> >
              <!-- Dropdown Trigger -->
                <a href="#!" class="dropdown-button" data-activates="dropdownAdmin">Administrador <i class="material-icons right">arrow_drop_down</i></a>
              </li>
            <?php endif; ?>
          </ul><!--/.right hide-on-med-and-down-->
          <?php endif; ?>

<!--parte oculta que se mostrara cuando se pulsa el menu hamburguesa-->

          <ul id="nav-mobile" class="side-nav">
            <li <?php if (View::checkForActiveController($filename, "index")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>">Página principal</a>
            </li>
            <?php if (Session::userIsLoggedIn()) { ?>
              <li <?php if (View::checkForActiveController($filename, "dashboard")) { echo ' class="active" '; } ?> >
                  <a href="<?php echo Config::get('URL'); ?>dashboard/index">Panel Trabajador</a>
              </li>
              <li <?php if (View::checkForActiveController($filename, "note")) { echo ' class="active" '; } ?> >
                  <a href="<?php echo Config::get('URL'); ?>note/index">Mis Anotaciones</a>
              </li>
              <!-- my account -->
              </li><li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                  <a href="<?php echo Config::get('URL'); ?>login/showprofile">Mi perfil</a>
              </li>
              <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                  <a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
              </li>
              <?php } else { ?>
                <!-- for not logged in users -->
                <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo Config::get('URL'); ?>login/index">Login</a>
                </li>
                <li <?php if (View::checkForActiveControllerAndAction($filename, "login/register")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo Config::get('URL'); ?>login/register">Registrate</a>
                </li>
              <?php } ?>
              <?php if (Session::get("user_account_type") == 7) : ?>
                <li <?php if (View::checkForActiveController($filename, "admin")) { echo ' class="active" ';  } ?> >
                <!-- Dropdown Trigger -->
                <a href="#!" class="dropdown-button" data-activates="dropdownAdminSideNav">Administrador <i class="material-icons right">arrow_drop_down</i></a>
              </li>
              <?php endif; ?>
          </ul><!--/.side-nav-->
        </div><!--/.nav-wrapper -->
      </nav>
    </div>
