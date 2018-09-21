<?php
  //Este archivo busca todas las películas en la BD y muestra en una tabla HTML el ID, el nombre y el género de cada una. Haciendo click sobre el nombre de cada película, se accede a los detalles de la misma.

  require 'classes/DB.php';
  require 'classes/MySQL_DB.php';
  require 'classes/Modelo.php';
  require 'classes/Movie.php';

  $db = new MySQL_DB;
  $peliculas = $db->findAll('movies');
  //echo "<pre>";
  //var_dump($peliculas);
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

    <h1>Base de Películas</h1>
    <span>
      <a href="index.php">Volver a Inicio</a>
      <a href="agregarpeli.php">Nueva Película</a>
      <a href="logout.php">Logout</a>
    </span>
    <br>
    <br>

      <div class="container">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Género</th>
              </tr>
            </thead>
            <?php foreach ($peliculas as $unaPelicula):?>
              <tbody>
                <tr>
                  <td><?=$unaPelicula->id?></td>
                  <td><a href="detalles.php?id=<?=$unaPelicula->id?>"><?=$unaPelicula->title?></a></td>
                  <td>
                    <?php
                      $genre_name = $db->find('genres', $unaPelicula->genre_id);
                      if($genre_name) {
                        echo $genre_name->name;
                      } else {
                        echo 'sin género';}
                    ?>
                  </td>
                </tr>
              </tbody>
            <?php endforeach; ?>
          </table>
        </div>
      </div>

  </body>
</html>
