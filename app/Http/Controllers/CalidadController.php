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

      /*$carrerasV11=\DB::select("
        SELECT carreras.nombre as nombres, datos.hombres,datos.mujeres from datos
        INNER JOIN indicadores on indicadores.id_indicador= datos.id_indicador
        INNER JOIN metas on datos.id_indicador = metas.id_indicador
        INNER JOIN carreras on carreras.id_carrera = datos.id_carrera
        WHERE datos.id_indicador=".$id." and datos.periodo =".$periodo."
        and metas.periodo=".$periodo."  and year(datos.created_at)=".$anio."
      ");

      $carrerasV1="";
      $valores1="";
      $valores2="";

      for($i = 0; $i<count($carrerasV11); $i++){
        $carrerasV1 = $carrerasV1 . '"' .$carrerasV11{$i}->nombres.'",';
        $valores1 = $valores1 . $carrerasV11{$i}->hombres.',';
        $valores2 = $valores2 . $carrerasV11{$i}->mujeres.',';
      }*/


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
    public function Graficas($id,$periodo,$anio){
      //SUMA DE LA COLUMNA DE HOMBRES
      $hombres=\DB::select("
      SELECT SUM(hombres) as suma FROM datos
      INNER JOIN indicadores on indicadores.id_indicador = datos.id_indicador
      INNER JOIN metas on metas.id_indicador = datos.id_indicador
      and metas.periodo=".$periodo." and datos.periodo=".$periodo."
      and datos.id_indicador=".$id." and Year(datos.created_at)=".$anio."
      ");
      //SUMA DE LA COLUMNA DE HOMBRES
      $hombres2=\DB::select("
      SELECT SUM(hombres2) as suma2 FROM datos
      INNER JOIN indicadores on indicadores.id_indicador = datos.id_indicador
      INNER JOIN metas on metas.id_indicador = datos.id_indicador
      and metas.periodo=".$periodo." and datos.periodo=".$periodo."
      and datos.id_indicador=".$id." and Year(datos.created_at)=".$anio."
      ");
      //SUMA DE LA COLUMNA DE MUJERES
      $mujeres=\DB::select("
      SELECT SUM(mujeres) as suma FROM datos
      INNER JOIN indicadores on indicadores.id_indicador = datos.id_indicador
      INNER JOIN metas on metas.id_indicador = datos.id_indicador
      and metas.periodo=".$periodo." and datos.periodo=".$periodo."
      and datos.id_indicador=".$id." and Year(datos.created_at)=".$anio."
      ");
      $mujeres2=\DB::select("
      SELECT SUM(mujeres2) as suma2 FROM datos
      INNER JOIN indicadores on indicadores.id_indicador = datos.id_indicador
      INNER JOIN metas on metas.id_indicador = datos.id_indicador
      and metas.periodo=".$periodo." and datos.periodo=".$periodo."
      and datos.id_indicador=".$id." and Year(datos.created_at)=".$anio."
      ");
      //TOTAL DE HOMBRES Y MUJERES DE LA VARIABLE 1
      $totalV1=\DB::select("
      select sum(hombres)+sum(mujeres) as totalV1 from datos
      INNER JOIN indicadores on indicadores.id_indicador = datos.id_indicador
      INNER JOIN metas on metas.id_indicador = datos.id_indicador
      and metas.periodo=".$periodo." and datos.periodo=".$periodo."
      and datos.id_indicador=".$id." and Year(datos.created_at)=".$anio."
      ");
      //TOTAL DE HOMBRES Y MUJERES DE LA VARIABLE 1
      $totalV2=\DB::select("
      select sum(hombres2)+sum(mujeres2) as totalV2 from datos
      INNER JOIN indicadores on indicadores.id_indicador = datos.id_indicador
      INNER JOIN metas on metas.id_indicador = datos.id_indicador
      and metas.periodo=".$periodo." and datos.periodo=".$periodo."
      and datos.id_indicador=".$id." and Year(datos.created_at)=".$anio."
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
    public function carreras($id,$periodo,$anio){
      //TOTAL DE HOMBRES Y MUJERES DE LA VARIABLE 1 CON SU RESPECTIVA CARRERA;
      $carrerasV11=\DB::select("
      SELECT carreras.nombre as nombres, datos.hombres,datos.mujeres from datos
      INNER JOIN indicadores on indicadores.id_indicador= datos.id_indicador
      INNER JOIN metas on datos.id_indicador = metas.id_indicador
      INNER JOIN carreras on carreras.id_carrera = datos.id_carrera
      WHERE datos.id_indicador=".$id." and datos.periodo =".$periodo."
      and metas.periodo=".$periodo."  and year(datos.created_at)=".$anio."
      ");

      $carrerasV1="";
      $valores1="";
      $valores2="";

      for($i = 0; $i<count($carrerasV11); $i++){
        $carrerasV1 = $carrerasV1 . '"' .$carrerasV11{$i}->nombres.'",';
        $valores1 = $valores1 . $carrerasV11{$i}->hombres.',';
        $valores2 = $valores2 . $carrerasV11{$i}->mujeres.',';
      }

      $todo = $carrerasV1 . "#" . $valores1 . "#" . $valores2;

      /*$arreglo[]=$carrerasV1;

      array_push($arreglo,$valores1,$valores2);*/

      return json_encode($todo);
    }
    public function porcentaje($id,$periodo,$anio){
      $porcentaje=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as porcentaje
        from datos where id_indicador=1 and periodo =1
      ");
    }
    public function nombre($id){
      $nombre=\DB::select("
      select nombre from indicadores where id_indicador=".$id."
      ");

      $variable=\DB::select("
        select variable1, variable2 from indicadores where id_indicador=".$id."
      ");

      $arreglo[]=$nombre;
      array_push($arreglo,$variable);
      return json_encode($arreglo);
    }
}
