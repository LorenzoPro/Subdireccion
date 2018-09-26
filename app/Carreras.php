<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
  //id categoria
  protected $primaryKey='id_carrera';
  //nombre de la tabla
  protected $table='carreras';
  //campos que se pueden manipular
  protected $fillable=[
    'nombre'
  ];
}
