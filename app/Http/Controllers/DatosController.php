<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Datos;
use Validator;

class DatosController extends Controller
{
    //
    public function index(){
    $carreras=\DB::table('carreras')
      ->orderBy('id_carrera')
      ->get();
      return view('admin.calidad')
        ->with('carreras', $carreras);
    }
    public function store(Request $req){

          $validator = Validator:: make($req->all(),[
            'hombres'=>'required|max:255',
            'mujeres'=>'required|max:255',
            'hombres2'=>'required|max:255',
            'mujeres2'=>'required|max:255',
            'id_carrera'=>'required',
            'id_indicador'=>'required'
          ]);
          if($validator->fails()){
            return $req;

          }else{

            Datos::create([
              'hombres'=>$req->hombres,
              'mujeres'=>$req->mujeres,
              'hombres2'=>$req->hombres2,
              'mujeres2'=>$req->mujeres2,
              'id_carrera'=>$req->id_carrera,
              'id_indicador'=>$req->id_indicador
            ]);
            return '1';
          }
    }
}
