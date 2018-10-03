<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metas extends Model
{

  protected $primaryKey='id_meta';
  protected $table='metas';
  protected $fillable=[
    'meta','periodo','tendencia','id_indicador'
  ];
}
