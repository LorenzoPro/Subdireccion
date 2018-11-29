<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Asignaciones;

class AsignacionesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index(){
    $title = "Oneami - Preguntas";
    return view('admin.usuarios')
      ->with('title', $title);
  }

  public function store(Request $req){
    $validator = Validator::make($req->all(),[
      'id'=>'required|max:255',
      'id_indicador'=>'required|max:255'
    ]);

    if($validator->fails()){
      return redirect('/administracion/usuarios')
        ->withInput()
        ->withErrors($validator);
    }else{
      Asignaciones::create([
        'id'=>$req->id,
        'id_indicador'=>$req->id_indicador
      ]);
      return redirect()->to('/administracion/usuarios')
        ->with('mensaje','Indicador Asignado');

    }
  }
}
