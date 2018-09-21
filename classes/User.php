<?php

class User extends Modelo //User en singular: clase de entidad
{
  public $table = 'users';
  public $columns = ['name', 'email', 'password'];//porqué no se pone el "id"????
}
