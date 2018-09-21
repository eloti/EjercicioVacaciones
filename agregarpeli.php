<?php

// Este archivo agrega una película nueva a la BD. Exige que el registro tenga al menos un título de película y un género.  Sin esos dos datos, no se carga la película nueva.

  require 'classes/DB.php';
  require 'classes/MySQL_DB.php';
  require 'classes/Modelo.php';
  require 'classes/Movie.php';

  //var_dump($_POST);

  $db = new MySQL_DB;
  $generos = $db->findAll('genres'); //para alimentar el desplegable y poder modificar el género
  $errorMessage = '';

  if ($_POST) { //si hay $_POST, va a ejecutar el if (para que no aparezca el error de entrada)
    if (!empty($_POST['title']) && !empty($_POST['genre_id'])) {

      $model = new Movie($_POST);//Usamos objetos!!
      $model->save();
      header('location:verpeliculas.php');
      } else {
        $errorMessage = 'Para dar de alta una película se debe cargar como mínimo el título y el género';
    }
  }

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

        <!--para mostrar el mensaje de error en la pantalla -->
        <?php if(!empty($errorMessage)): ?> <!-- si no está vacío el mensaje, es porque hay error -->
          <p><?= $errorMessage ?></p> <!--el "=" es para que lo muestre por pantalla-->
        <?php endif; ?>

        <h1>Alta de Película</h1>
        <span>
          <a class="abutton" href="verpeliculas.php">Volver</a>
          <a href="logout.php">Logout</a>
        </span>
        <br>
        <br>

        <div class="container">

          <form class="form-horizontal" action="agregarpeli.php" method="post">

            <div class="form-group">
              <label class="control-label col-sm-2" for="title">Título:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="genero">Género:</label>
              <div class="col-sm-10">
                <select class="col-sm-10 genero" name="genre_id">
                  <?php foreach ($generos as $unGenero): ?>
                  <option value="<?=$unGenero->id?>"><?=$unGenero->name?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="release_date">Fecha de estreno:</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" id="release_date" placeholder="dd/mm/aaaa" name="release_date">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="length">Duración en minutos:</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="length" name="length">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="awards">Cantidad de premios:</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="awards" name="awards">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="rating">Puntaje:</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="rating" name="rating">
              </div>
            </div>

            <a class="abutton"><input class="inputbutton" type="submit" value="Agregar"></a>

          </form>
        </div>

  </body>
</html>
