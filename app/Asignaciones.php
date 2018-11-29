<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignaciones extends Model
{
  protected $primaryKey='id_asignaciones';
  //nombre de la tabla
  protected $table='asignaciones';
  //campos que se pueden manipular
  protected $fillable=[
    'id','id_indicador'
  ];
}
