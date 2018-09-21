<?php

class Modelo
{
  public $table;
  public $columns;
  public $datos;
  protected $db;

  public function __construct($datos=[]) {
    $this->datos = $datos;
    $this->db = new MySQL_DB();
  }

  public function save() {
    if (!$this->getAttr('id')) {
      $this->insert();
    } else {
      $this->update();
    }
  }

  private function insert() {
    $this->db->insert($this->datos, $this); //esta función está en MySQL_DB
  }

  //función update mía
  private function update() {
    $this->db->update($this->datos, $this);
  }

  public function getAttr($attr) {//tiene que estar la película instanciada
    return isset($this->datos[$attr]) ? $this->datos[$attr] : null;
  }

  public function setAttr($attr, $value) {
    $this->datos[$attr] = $value;
  }
}
