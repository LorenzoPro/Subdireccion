<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datos extends Model
{
  protected $primaryKey='id_dato';
  protected $table='datos';
  protected $fillable=[
    'id_dato','hombres','mujeres','hombres2','mujeres2','id_carrera','id_indicador'
  ];
}
