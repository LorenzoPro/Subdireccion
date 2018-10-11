<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Carreras;
use App\Datos;

class CalidadController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
      $indicador=\DB::table('indicadores')
        ->orderBy('id_indicador')
        ->get();



      $carreras=\DB::table('carreras')
        ->orderBy('id_carrera')
        ->get();

        $metas=\DB::table('indicadores')
          ->select('indicadores.*','metas.*')
          ->join('metas','metas.id_indicador','=','indicadores.id_indicador')
          ->get();

      return view('admin.calidad')
        ->with('indicadores', $indicador)
        ->with('carreras', $carreras)
        ->with('metas', $metas);


    }
    public function ajax(Request $req){
          $datos=\DB::table('datos')
          ->where('id_indicador','=',$req->id_indicador)
          ->get();
          return json_encode($datos);
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
    public function Graficas($id,$periodo){
      $hombres=\DB::select("
      SELECT SUM(hombres) FROM datos
      INNER JOIN indicadores on indicadores.id_indicador = datos.id_indicador
      INNER JOIN metas on metas.id_indicador = datos.id_indicador and periodo='Enero-Julio' and datos.id_indicador=".$id."
      ");

      $mujeres=\DB::select("
      SELECT SUM(mujeres) FROM datos
      INNER JOIN indicadores on indicadores.id_indicador = datos.id_indicador
      INNER JOIN metas on metas.id_indicador = datos.id_indicador and periodo=".$periodo." and datos.id_indicador='3'
      ");

      $todo=$hombres;



      $nombre=\DB::select("
      select nombre from indicadores where id_indicador=".$id."
      ");


      return json_encode($nombre);



    }
}
