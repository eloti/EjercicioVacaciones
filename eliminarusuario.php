<?php

require 'classes/DB.php';
require 'classes/MySQL_DB.php';
require 'classes/Modelo.php';
require 'classes/User.php';

//var_dump($_GET);

$db = new MySQL_DB;
$db->delete('users', $_GET['id']);
header('location:verusuarios.php');

?>
