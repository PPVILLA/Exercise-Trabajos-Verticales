# Exercise of Web Application "Trabajos Verticales"

### Introduction
This web application is the result of an exercise of last year DAW top grade in school C.D.P. Jose Cabrera.

Thank all the developers in the community who contributed in creating this PHP application based on which the project is based: [HUGE](https://github.com/panique/huge).

#### Introduction in Spanish:
Esta aplicación web es el resultado de un ejercicio del último curso del grado superior DAW, en el  instituto C.D.P. José Cabrera.

Agradecer a todos los desarrolladores de la comunidad que aportaron en la creación de esta base de aplicación PHP, sobre la cual se asienta este proyecto: [HUGE](https://github.com/panique/huge).

### Features
* built with the official PHP password hashing functions, fitting the most modern password hashing/salting web standards
* proper security features, like CSRF blocking (via form tokens), encryption of cookie contents etc.
* users can register, login, logout (with username, email, password)
* password-forget / reset
* remember-me (login via cookie)
* account verification via mail
* captcha
* failed-login-throttling
* user profiles
* account upgrade / downgrade
* simple user types (type 1, type 2, admin)
* supports local avatars and remote Gravatars
* supports native mail and SMTP sending (via PHPMailer and other tools)
* uses PDO for database access for sure, has nice DatabaseFactory (in case your project goes big)
* uses URL rewriting ("beautiful URLs")
* proper split of application and public files (requests only go into /public)
* uses Composer to load external dependencies (PHPMailer, Captcha-Generator, etc.) for sure
* fits PSR-0/1/2/4 coding guidelines
* uses [Post-Redirect-Get pattern](https://en.wikipedia.org/wiki/Post/Redirect/Get) for nice application flow
* masses of comments
* is actively developed, maintained and bug-fixed

### License

Licensed under [MIT](http://www.opensource.org/licenses/mit-license.php).
Totally free for private or commercial projects.

### Requirements

Make sure you know the basics of object-oriented programming and MVC, are able to use the command line and have
used Composer before. This script is not for beginners.

* **PHP 5.5+**
* **MySQL 5** database (better use versions 5.5+ as very old versions have a [PDO injection bug](http://stackoverflow.com/q/134099/1114320)
* installed PHP extensions: pdo, gd, openssl (the install guideline shows how to do)
* installed tools on your server: git, curl, composer (the install guideline shows how to do)
* for professional mail sending: an SMTP account (I use [SMTP2GO](http://www.smtp2go.com/?s=devmetal))
* activated mod_rewrite on your server (the install guideline shows how to do)

#### The different user roles

Currently there are two types of users: Normal users and admins. There are exactly the same, but...

1. Admin users can delete and suspend other users, they have an additional button "admin" in the navigation. Admin users
have a value of `7` inside the database table field `user_account_type`. They cannot upgrade or downgrade their accounts
(as this wouldn't make sense).

2. Normal users don't have admin features for sure. But they can upgrade and downgrade their accounts (try it out via
/login/changeUserRole), which is basically a super-simple implementation of the basic-user / premium-user concept.
Normal users have a value of `1` or `2` inside the database table field `user_account_type`. By default all new
registered users are normal users with user role 1 for sure.

See the "Testing with demo users" section of this readme for more info.

#### An introduction into the CSRF features

To prevent [CSRF attacks](https://en.wikipedia.org/wiki/Cross-site_request_forgery), HUGE does this in the most common
way, by using a security *token* when the user submits critical forms. This means: When PHP renders a form for the user,
the application puts a "random string" inside the form (as a hidden input field), generated via Csrf::makeToken()
(application/core/Csrf.php), which also saves this token to the session. When the form is submitted, the application
checks if the POST request contains exactly the form token that is inside the session.

This CSRF prevention feature is currently implemented on the login form process (see *application/view/login/index.php*)
and user name change form process (see *application/view/login/editUsername.php*), most other forms are not security-
critical and should stay as simple as possible.

A big thanks to OmarElGabry for implementing this!

### Useful links

- [How to use PDO](http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers)
- [A short guideline on how to use the PHP 5.5 password hashing functions and its PHP 5.3 & 5.4 implementations](http://www.dev-metal.com/use-php-5-5-password-hashing-functions/)
- [How to setup latest version of PHP 5.5 on Ubuntu 12.04 LTS](http://www.dev-metal.com/how-to-setup-latest-version-of-php-5-5-on-ubuntu-12-04-lts/)
- [How to setup latest version of PHP 5.5 on Debian Wheezy 7.0/7.1 (and how to fix the GPG key error)](http://www.dev-metal.com/setup-latest-version-php-5-5-debian-wheezy-7-07-1-fix-gpg-key-error/)
- [Notes on password & hashing salting in upcoming PHP versions (PHP 5.5.x & 5.6 etc.)](https://github.com/panique/huge/wiki/Notes-on-password-&-hashing-salting-in-upcoming-PHP-versions-%28PHP-5.5.x-&-5.6-etc.%29)
- [Some basic "benchmarks" of all PHP hash/salt algorithms](https://github.com/panique/huge/wiki/Which-hashing-&-salting-algorithm-should-be-used-%3F)
- [How to prevent PHP sessions being shared between different apache vhosts / different applications](http://www.dev-metal.com/prevent-php-sessions-shared-different-apache-vhosts-different-applications/)

## Interesting links regarding user authentication and application security

- [interesting article about password resets (by Troy Hunt, security expert)](http://www.troyhunt.com/2012/05/everything-you-ever-wanted-to-know.html)
- Password-Free Email Logins: [Ticket & discussion](https://github.com/panique/huge/issues/674), [article](http://techcrunch.com/2015/06/30/blogging-site-medium-rolls-out-password-free-email-logins/?ref=webdesignernews.com)
- Logging in via QR code: [Ticket & discussion](https://github.com/panique/huge/issues/290), [english article](https://www.grc.com/sqrl/sqrl.htm),
  [german article](http://www.phpgangsta.de/sesam-oeffne-dich-sicher-einloggen-im-internetcafe),
  [repo](https://github.com/PHPGangsta/Sesame), [live-demo](http://sesame.phpgangsta.de/). Big thanks to *PHPGangsta* for writing this!
