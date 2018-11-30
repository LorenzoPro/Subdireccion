<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estrategias extends Model
{
  protected $primaryKey='id_estrategias';
  //nombre de la tabla
  protected $table='estrategias';
  //campos que se pueden manipular
  protected $fillable=[
    'estrategias','observaciones','id_indicador','periodo'
  ];
}
