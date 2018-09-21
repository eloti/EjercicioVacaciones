<?php
  session_start();

  require 'classes/DB.php';
  require 'classes/MySQL_DB.php';
  require 'classes/Modelo.php';
  require 'classes/User.php';

  $message = '';
  $db = new MySQL_DB;

// chequea que esté recibiendo el email, el usuario y el password por POST. Los nombres email, username y password están definidos en el formulario de más abajo con "name"

    if($_POST) {
      if (!empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['password'])) {

        $passwordEnc = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $_POST['password'] = $passwordEnc;

        $model = new User($_POST);//Usamos objetos!!
        $model->save();

        $usuario = $db->findUser('users', $_POST['email']);
        $_SESSION['user_id'] = $usuario->id;
        var_dump($_SESSION);
        header('Location: /EjercicioVacaciones');

        } else {
          $message = 'Faltan datos para su correcto registro';
      }
    }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign up</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
  </head>
  <body>
    <?php require 'partials/header.php';?>

    <!--para mostrar el mensaje de error en la pantalla -->
    <?php if(!empty($message)): ?> <!-- si no está vacío el mensaje, es porque hay error -->
      <p><?= $message ?></p> <!--el "=" es para que lo muestre por pantalla-->
    <?php endif; ?>

    <h1>Regístrese o</h1>
    <span>
      <a href="login.php">Login</a>
    </span>

      <form action="registro.php" method="post">
        <input type="text" name="email" placeholder="Ingrese su email">
        <input type="text" name="name" placeholder="Ingrese su nombre">
        <input type="password" name="password" placeholder="Ingrese su contraseña">
        <input type="password" name="confirm_password" placeholder="Confirme su contraseña">
        <a class="abutton"><input class="inputbutton" type="submit" value="Enviar"></a>
      </form>

  </body>
</html>
