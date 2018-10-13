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
      //SUMA DE LA COLUMNA DE HOMBRES
      $hombres=\DB::select("
      SELECT SUM(hombres) as suma FROM datos
      INNER JOIN indicadores on indicadores.id_indicador = datos.id_indicador
      INNER JOIN metas on metas.id_indicador = datos.id_indicador
      and metas.periodo=".$periodo." and datos.periodo=".$periodo." and datos.id_indicador=".$id."
      ");
      //SUMA DE LA COLUMNA DE HOMBRES
      $hombres2=\DB::select("
      SELECT SUM(hombres2) as suma2 FROM datos
      INNER JOIN indicadores on indicadores.id_indicador = datos.id_indicador
      INNER JOIN metas on metas.id_indicador = datos.id_indicador
      and metas.periodo=".$periodo." and datos.periodo=".$periodo." and datos.id_indicador=".$id."
      ");
      //SUMA DE LA COLUMNA DE MUJERES
      $mujeres=\DB::select("
      SELECT SUM(mujeres) as suma FROM datos
      INNER JOIN indicadores on indicadores.id_indicador = datos.id_indicador
      INNER JOIN metas on metas.id_indicador = datos.id_indicador
      and metas.periodo=".$periodo." and datos.periodo=".$periodo." and datos.id_indicador=".$id."
      ");
      $mujeres2=\DB::select("
      SELECT SUM(mujeres2) as suma2 FROM datos
      INNER JOIN indicadores on indicadores.id_indicador = datos.id_indicador
      INNER JOIN metas on metas.id_indicador = datos.id_indicador
      and metas.periodo=".$periodo." and datos.periodo=".$periodo." and datos.id_indicador=".$id."
      ");
      //TOTAL DE HOMBRES Y MUJERES DE LA VARIABLE 1
      $totalV1=\DB::select("
      select sum(hombres)+sum(mujeres) as totalV1 from datos
      INNER JOIN indicadores on indicadores.id_indicador = datos.id_indicador
      INNER JOIN metas on metas.id_indicador = datos.id_indicador
      and metas.periodo=".$periodo." and datos.periodo=".$periodo." and datos.id_indicador=".$id."
      ");
      //TOTAL DE HOMBRES Y MUJERES DE LA VARIABLE 1
      $totalV2=\DB::select("
      select sum(hombres2)+sum(mujeres2) as totalV2 from datos
      INNER JOIN indicadores on indicadores.id_indicador = datos.id_indicador
      INNER JOIN metas on metas.id_indicador = datos.id_indicador
      and metas.periodo=".$periodo." and datos.periodo=".$periodo." and datos.id_indicador=".$id."
      ");


      $arreglo[]=$hombres;
      /*$valores1="";
      $valores2="";

      $valores1=$valores1 . '"' .$hombres{0}->suma.'",';
      $valores2=$valores2 . '"' .$mujeres{0}->suma.'",';
      $todo=$valores1. "#" .$valores2;*/
      //$arreglo.push('Hombres',$hombre);
      //$arreglo.push('Mujeres',$mujeres);
    //  array_push($arreglo,$hombres);
      array_push($arreglo,$mujeres,$totalV1,$hombres2,$mujeres2,$totalV2);
      return json_encode($arreglo);

    }
    public function nombre($id){
      $nombre=\DB::select("
      select nombre from indicadores where id_indicador=".$id."
      ");
      return json_encode($nombre);
    }
}
