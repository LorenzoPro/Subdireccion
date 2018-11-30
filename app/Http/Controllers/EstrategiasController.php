<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Estrategias;

class EstrategiasController extends Controller
{
  public function index(){

    return view('admin');

  }
  public function store(Request $req){
    $validator = Validator::make($req->all(),[
      'estrategias'=>'required|max:255',
      'observaciones'=>'required|max:255',
      'id_indicador'=>'required|max:255',
      'periodo'=>'required|max:255'
    ]);

    if($validator->fails()){
      return redirect('/administracion/usuarios')
        ->withInput()
        ->withErrors($validator);
    }else{
      Estrategias::create([
        'estrategias'=>$req->estrategias,
        'observaciones'=>$req->observaciones,
        'id_indicador'=>$req->id_indicador,
        'periodo'=>$req->periodo,
      ]);
      return redirect()->to('/administracion')
        ->with('mensaje','Estrategias Agregadas');

    }
  }
}
