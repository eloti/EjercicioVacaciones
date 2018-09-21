<?php

  session_start();

  //esto es para que no me pida loguear cuando ya estoy logueado:
  if (isset($_SESSION['user_id'])) { //si está configurada la sesión y existe el user_id
    header('Location: /EjercicioVacaciones'); //redireccionamos a la ruta inicial de nuestra aplicación
  }

  require 'classes/DB.php';
  require 'classes/MySQL_DB.php';
  require 'classes/Modelo.php';
  require 'classes/User.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {

    $db = new MySQL_DB;
    $usuario = $db->findUser('users', $_POST['email']);

    $message ='';

    if (!empty($usuario) && password_verify($_POST['password'], $usuario->password)) {
      //password_verify es una función de PHP que compara el password que viene del POST con el de $results
      $_SESSION['user_id'] = $usuario->id;
      //si verifica password, almacena el usuario en la variable de sesión
      header('Location: /EjercicioVacaciones');
    } else {
      $message = 'Hay un error en su logueo';
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
  </head>
  <body>

    <?php require 'partials/header.php';?>

    <h1>Login o</h1>
    <span>
      <a href="registro.php">Regístrese</a>
    </span>

    <?php if (!empty($message)) : ?>
      <p><?= $message ?></p>
    <?php endif;?>

    <form action="login.php" method="post">
      <input type="text" name="email" placeholder="Ingrese su email">
      <input type="password" name="password" placeholder="Ingrese su contraseña">
      <a class="abutton"><input class="inputbutton" type="submit" value="Enviar"></a>
    </form>
  </body>
</html>
