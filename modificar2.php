<?php

//recibe un $_GET de la película de modificar.php. Crea mediante un nuevo objeto la película "nueva" que en realidad es modificada. Una vez modificado te lleva a detalle.php donde se verán los detalles de la película modificada.

require 'classes/DB.php';
require 'classes/MySQL_DB.php';
require 'classes/Modelo.php';
require 'classes/Movie.php';

var_dump($_POST);//recibe el array de la película de modificar.php

$model = new Movie($_POST);//Usamos objetos!!
$model->save();

header('location:detalles.php?id='.$_POST['id']);

 ?>
