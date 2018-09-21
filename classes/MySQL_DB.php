<?php

class MySQL_DB extends DB {

  protected $conn;

  public function __construct() {
    try {
      $this->conn = new PDO('mysql:host=localhost;dbname=movies_db', 'root', '');
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
  }

  public function insert($datos, $modelo) {
    $columnas = '';
    $values = '';

    foreach ($datos as $key => $value) {
    if (in_array($key, $modelo->columns)) {
        $columnas .= $key . ',';
        $values .= '"' . $value . '",';
      }
    }

    $columnas = trim($columnas, ',');
    $values = trim($values, ',');
    $sql = 'insert into '.$modelo->table.' ('.$columnas.') values ('.$values.')';

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
    } catch(Exception $e) {
      $e->getMessage();
    }
  }

    public function update($datos, $modelo) {
      $set = '';

      foreach ($datos as $key => $value) {
        $set .= $key . '="' . $value . '",';
      }

      $set = trim($set, ',');
      $sql = 'UPDATE '.$modelo->table.' set ' . $set . ' WHERE id = ' . $modelo->getAttr('id');

      try {
        $stmt = $this->conn->prepare($sql);
          $stmt->execute();
      } catch(Exception $e) {
        $e->getMessage();
      }
    }

//trae un registro en base a un id:
    public function find($table, $id) {
      $sql = 'SELECT * FROM '. $table .' WHERE id = :id';
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':id', $id);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    }
//trae un usuario en base a un email:
    public function findUser($table, $email) {
      $sql = 'SELECT * FROM '. $table .' WHERE email = :email';
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':email', $email);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    }
//esta la hago yo, para buscar todos los registros de una tabla:
    public function findAll($table) {
      $sql = 'SELECT * FROM '. $table;
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
//esta la hago yo, para eliminar un registro de una tabla:
    public function delete($table, $id) {
      $sql = 'DELETE FROM '. $table .' WHERE id = :id';
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':id', $id);
      $stmt->execute();
    }

}

?>
