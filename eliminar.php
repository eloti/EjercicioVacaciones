<?php

//recibe un $_GET de detalles.php con el ID de la película a eliminar.  Elimina y regresa al listado general de películas: verpeliculas.php.

require 'classes/DB.php';
require 'classes/MySQL_DB.php';
require 'classes/Modelo.php';
require 'classes/Movie.php';

var_dump($_GET);

$db = new MySQL_DB;
$db->delete('movies', $_GET['id']);
header('location:verpeliculas.php');

?>
