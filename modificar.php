<?php
//este archivo recibe un $_GET de detalles.php que contiene el 'id' de la película a modificar.  Con ese id busca el resto de los detalles de la película y los carga en el formulario con placeholder, cosa que muestre el valor de los campos que trae pero que permita modificarlos. Luego de modificar el formulario se envía un $_GET a modificar2.php con los detalles completos a modificar.

  require 'classes/DB.php';
  require 'classes/MySQL_DB.php';
  require 'classes/Modelo.php';
  require 'classes/Movie.php';

  //var_dump($_GET);

  $db = new MySQL_DB;
  $pelicula = $db->find('movies', $_GET['id']);
  $genero = $db->find('genres', $pelicula->genre_id); //busca el nombre del género en la tabla genres
  $generos = $db->findAll('genres'); //para alimentar el desplegable y poder modificar el género

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Altas</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
  </head>

  <body>
    <?php require 'partials/header.php';?>

    <h1>Modificar Película</h1>
      <span>
        <a class="abutton" href="detalles.php?id=<?=$pelicula->id?>">Volver a Detalle</a> <!--para volver a la hoja detalles.php sin modificar la película -->
        <a href="logout.php">Logout</a>
      </span>
    <br>
    <br>

    <div class="container">

      <form class="form-horizontal" action="modificar2.php" method="post">

        <div class="form-group">
          <label class="control-label col-sm-2" for="id">ID:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="id" name="id" value="<?=$pelicula->id?>" readonly>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="title">Título:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" value="<?=$pelicula->title?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="title">Género</label>
          <div class="col-sm-10">
            <select class="form-control" name="genre_id">
              <?php foreach ($generos as $unGenero): ?>
                <?php if ($pelicula->genre_id==$unGenero->id): ?>
                  <option selected value="<?=$unGenero->id?>"><?=$unGenero->name?></option>
                <?php else: ?>
                <option value="<?=$unGenero->id?>"><?=$unGenero->name?></option>
              <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="release_date">Fecha de estreno:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="release_date" name="release_date" value="<?=date("d-m-Y", strtotime($pelicula->release_date))?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="length">Duración en minutos:</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="length" name="length" value="<?=$pelicula->length?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="awards">Cantidad de premios:</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="awards" name="awards" value="<?=$pelicula->awards?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="rating">Puntaje:</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="rating" name="rating" value="<?=$pelicula->rating?>">
          </div>
        </div>

        <span>
          <a class="abutton"><input class="inputbutton" type="submit" value="Modificar"></a>
          <a class="abutton" href="detalles.php?id=<?=$pelicula->id?>">Volver a Detalle</a>
        </span>


      </form>
    </div>

  </body>
</html>
