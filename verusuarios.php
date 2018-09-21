<?php
  
  require 'classes/DB.php';
  require 'classes/MySQL_DB.php';
  require 'classes/Modelo.php';
  require 'classes/User.php';

  $db = new MySQL_DB;
  $usuarios = $db->findAll('users');

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Peliculas</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
  </head>

  <body>

    <?php require 'partials/header.php';?>

    <h1>Base de Usuarios</h1>
    <span>
      <a href="index.php">Volver</a>
      <a href="logout.php">Logout</a>
    </span>
    <br>
    <br>

      <div class="container">
        <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>email</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <?php foreach ($usuarios as $unUsuario): ?>
          <tbody>
            <tr>
              <td><?=$unUsuario->name?></td>
              <td><?=$unUsuario->email?></td>
              <td><a href="eliminarusuario.php?id=<?=$unUsuario->id?>">Eliminar</a></td>
            </tr>
          </tbody>
          <?php endforeach; ?>
        </table>
        </div>
      </div>

  </body>
</html>
