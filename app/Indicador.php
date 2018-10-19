<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
  //id inscripcion
  protected $primaryKey='id_indicador';
  //nombre de la tabla
  protected $table='indicadores';
  //campos que se pueden manipular
  protected $fillable=[
    'id_indicador','nombre','area','objetivo','variable1','variable2'
  ];
}
