<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Metas;


class MetasController extends Controller
{
  public function index(){

    return view('admin.metas')
      ->with('metas', $metas);
  }
    //insertar
    public function store(Request $req){
      $validator = Validator::make($req->all(),[
        'meta'=>'required|max:255',
        'periodo'=>'required|max:255',
        'tendencia'=>'required|max:255',
        'id_indicador'=>'required|max:255'
      ]);

      if($validator->fails()){
        return redirect('/administracion')
          ->withInput()
          ->withErrors($validator);
      }else{
        Metas::create([
          'meta'=>$req->meta,
          'periodo'=>$req->periodo,
          'tendencia'=>$req->tendencia,
          'id_indicador'=>$req->id_indicador,
        ]);

        return 1;

      }
    }//llave insertar
}
