<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Carreras;

class CarrerasController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }
  public function index(){
    $carreras=\DB::table('carreras')
    ->orderBy('id_carrera','nombre')
    ->get();
    $title = "ITSNCG - Ingenierias";
    return view('admin.carreras')
      ->with('titulo', $title)
      ->with('carreras', $carreras);
  }
  //insetar
  public function store(Request $req){
    $validator = Validator::make($req->all(),[
      'nombre'=>'required|max:255'
    ]);

    if($validator->fails()){
      return redirect('administracion/carreras')
        ->withInput()
        ->withErrors($validator);
    }else{
      Carreras::create([
        'nombre'=>$req->nombre
      ]);
      return redirect()->to('/administracion/carreras')
        ->with('mensaje','Categoria Agregada');
    }
  }
  //borrar
  public function destroy($id){
    $carreras= Carreras::find($id);
    $carreras->delete();
    return redirect('/administracion/carreras');
  }
  public function edit(Request $req){
    $carreras=Carreras::find($req->id);
    $carreras->nombre=$req->nameEditar;
    $carreras->save();
    return redirect('/administracion/carreras/')
      ->with('mensaje','Registro Actualizado');
  }
}
