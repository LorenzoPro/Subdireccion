<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Indicador;

class IndicadoresController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index(){
    $indicador=\DB::table('indicadores')
      ->orderBy('id_indicador')
      ->get();
    $titulo = "ITSNCG - Indicadores";
    return view('admin.indicadores')
      ->with('titulo', $titulo)
      ->with('indicadores', $indicador);


  }
  //insertar
  public function store(Request $req){
    $validator = Validator::make($req->all(),[
      'nombre'=>'required|max:255',
      'area'=>'required|max:255',
      'objetivo'=>'required|max:800',
      'variable1'=>'required|max:100',
      'variable2'=>'required|max:100'
    ]);

    if($validator->fails()){
      return redirect('/administracion/indicadores')
        ->withInput()
        ->withErrors($validator);
    }else{
      Indicador::create([
        'nombre'=>$req->nombre,
        'area'=>$req->area,
        'objetivo'=>$req->objetivo,
        'variable1'=>$req->variable1,
        'variable2'=>$req->variable2
      ]);
      return redirect()->to('/administracion/indicadores')
        ->with('mensaje','Indicador Agregado');

    }
  }
  //borrar
  public function destroy($id){
    $indicador= Indicador::find($id);
    $indicador->delete();
    return redirect('/administracion/indicadores');
  }
  //editar
  public function edit(Request $req){
    $indicador=Indicador::find($req->id);
    $indicador->nombre=$req->nameEditar;
    $indicador->area=$req->areaEditar;
    $indicador->objetivo=$req->objetivoEditar;
    $indicador->save();
    return redirect('/administracion/indicadores')
      ->with('mensaje','Registro Actualizado');
  }
}
