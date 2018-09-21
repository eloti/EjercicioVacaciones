<?php

abstract class DB {//nunca se va a usar, obliga a todas las clases hijas que tengan que declarar un método que sea insertar con los mismo parámetros

  abstract public function insert($datos, $modelo);
  abstract public function update($datos, $modelo);
  abstract public function find($table, $id);
  abstract public function findUser($table, $email);
  abstract public function findAll($table);
  abstract public function delete($table, $id);

}
