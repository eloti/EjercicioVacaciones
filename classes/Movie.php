<?php

class Movie extends Modelo //Movie en singular: clase de entidad
{
  public $table = 'movies';
  public $columns = ['title', 'rating', 'awards', 'release_date', 'length', 'genre_id'];//porqué no se pone el "id"????
}
