<?php

class Genre extends Modelo //Genre en singular: clase de entidad
{
  public $table = 'genres';
  public $columns = ['name', 'ranking', 'active'];//porqué no se pone el "id"????
}
