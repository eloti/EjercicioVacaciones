<?php
  //Este archivo recibe de verpeliculas.php un $_GET array(1) {["id"]=>string(1)"1"} con el ID de la película que se seleccionó para visualizar los detalles. Los detalles de la película seleccionada se cargan en un formulario readonly.

  require 'classes/DB.php';
  require 'classes/MySQL_DB.php';
  require 'classes/Modelo.php';
  require 'classes/Movie.php';
  //var_dump($_GET); //llega el id de la película

  $db = new MySQL_DB;
  $pelicula = $db->find('movies', $_GET['id']);
  $genero = $db->find('genres', $pelicula->genre_id); //busca el nombre del género en la tabla genres

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

    <h1>Detalle de Película</h1>
    <span>
      <a href="verpeliculas.php">Volver a lista de películas</a>
      <a href="logout.php">Logout</a>
    </span>
    <br>
    <br>
    <div class="container">

      <form class="form-horizontal" action="modificar2.php" method="get">

        <div class="form-group">
          <label class="control-label col-sm-2" for="id">ID:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="id" name="id" value="<?=$pelicula->id?>" readonly>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="title">Título:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" value="<?=$pelicula->title?>" readonly>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="title">Género</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" value="<?=$genero->name?>" readonly>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="release_date">Fecha de estreno:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="release_date" name="release_date" value="<?=$pelicula->release_date?>" readonly>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="length">Duración en minutos:</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="length" name="length" value="<?=$pelicula->length?>" readonly>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="awards">Cantidad de premios:</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="awards" name="awards" value="<?=$pelicula->awards?>" readonly>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="rating">Puntaje:</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="rating" name="rating" value="<?=$pelicula->rating?>" readonly>
          </div>
        </div>

        <span>
          <a class="abutton" href="modificar.php?id=<?=$pelicula->id?>">Modificar</a>
          <a class="abutton" href="eliminar.php?id=<?=$pelicula->id?>">Eliminar</a>
        </span>

      </form>
    </div>



  </body>
</html>
