<?php
  session_start(); //ve si la sesión existe

  require 'classes/DB.php';
  require 'classes/MySQL_DB.php';
  require 'classes/Modelo.php';
  require 'classes/User.php';

  //var_dump($_SESSION); //trae el ID del usuario que está logueado. Si no hay nadie logueado es un array vacío.

  if (isset($_SESSION['user_id'])) { //si existe la variable user_id dentro de la sesión...

    $db = new MySQL_DB;
    $usuario = $db->find('users', $_SESSION['user_id']);
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Bienvenido</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">

  </head>
  <body>

    <?php require 'partials/header.php';?>

    <?php if(!empty($usuario)): ?> <!--si no está vacío $user damos la bienvenida-->

      <br>
      <h1>Bienvenido!</h1>
      <br>
      <?= $usuario->name; ?>
      <h2>Usted se ha logueado correctamente</h2>
      <br>
      <a href="verpeliculas.php">Ir a películas</a>
      <a href="verusuarios.php">Ir a usuarios</a>
      <a href="logout.php">Logout</a>

    <?php else: ?> <!--si no está logueado, o sea si $user está vacío, va a presentar esto en la pantalla: -->

      <h1>Por favor ingrese con su usuario o regístrese</h1>
      <a href="login.php">Login</a> or
      <a href="registro.php">Regístrese</a>

    <?php endif; ?>
  </body>
</html>
