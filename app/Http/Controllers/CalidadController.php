<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Carreras;
use App\Datos;
use Carbon;

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

        $id = \Auth::user()->id;

        $asignaciones=\DB::select("
          select * from indicadores
          INNER JOIN asignaciones on asignaciones.id_indicador = indicadores.id_indicador
          INNER JOIN users on users.id = asignaciones.id
          where users.id=".$id."
        ");




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
      $time = Carbon\Carbon::now();


      return view('admin.calidad')
        ->with('indicadores', $indicador)

        ->with('carreras', $carreras)
        ->with('asignaciones', $asignaciones)
        ->with('tiempo',date_format($time, 'Y'))
        ->with('metas', $metas);


    }
    public function ajax(Request $req){
          $datos=\DB::table('datos')
          ->where('id_indicador','=',$req->id_indicador)
          ->get();
          return json_encode($datos);
    }
    public function eliminar($id,$periodo,$anio){
      $meta=\DB::select("
      DELETE from metas where id_indicador=".$id." and periodo= ".$periodo." and year(metas.created_at)=".$anio."
      ");

      $datos=\DB::select("
      DELETE from datos where id_indicador=".$id." and periodo= ".$periodo." and year(datos.created_at)=".$anio."
      ");



      return 1;


    }
    public function store(Request $req){

          $validator = Validator:: make($req->all(),[
            'hombres'=>'required|max:255',
            'mujeres'=>'required|max:255',
            'hombres2'=>'required|max:255',
            'mujeres2'=>'required|max:255',
            'periodo'=>'required|max:255',
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
              'periodo'=>$req->periodo,
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
      SELECT carreras.nombre as nombres, datos.hombres,datos.mujeres, datos.hombres2, datos.mujeres2 from datos
      INNER JOIN indicadores on indicadores.id_indicador= datos.id_indicador
      INNER JOIN metas on datos.id_indicador = metas.id_indicador
      INNER JOIN carreras on carreras.id_carrera = datos.id_carrera
      WHERE datos.id_indicador=".$id." and datos.periodo =".$periodo."
      and metas.periodo=".$periodo."  and year(datos.created_at)=".$anio."
      ");

      $carrerasV1="";
      $valores1="";
      $valores2="";
      $valores3="";
      $valores4="";

      for($i = 0; $i<count($carrerasV11); $i++){
        $carrerasV1 = $carrerasV1 . '"' .$carrerasV11{$i}->nombres.'",';
        $valores1 = $valores1 . $carrerasV11{$i}->hombres.',';
        $valores2 = $valores2 . $carrerasV11{$i}->mujeres.',';
        $valores3 = $valores3 . $carrerasV11{$i}->hombres2.',';
        $valores4 = $valores4 . $carrerasV11{$i}->mujeres2.',';
      }

      $todo = $carrerasV1."#".$valores1."#".$valores2."#".$valores3."#".$valores4;

      /*$arreglo[]=$carrerasV1;

      array_push($arreglo,$valores1,$valores2);*/

      return json_encode($todo);
    }
    public function porcentaje($id,$periodo,$anio){
      $anio2=$anio-1;
      $anio3=$anio2-1;
      $anio4=$anio3-1;
      $anio5=$anio4-1;
      $porcentaje=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =".$periodo." and year(datos.created_at)=".$anio."
      ");
      $porcentaje2=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =".$periodo." and year(datos.created_at)=".$anio2."
      ");
      $porcentaje3=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =".$periodo." and year(datos.created_at)=".$anio3."
      ");
      $porcentaje4=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =".$periodo." and year(datos.created_at)=".$anio4."
      ");
      $porcentaje5=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =".$periodo." and year(datos.created_at)=".$anio5."
      ");
      $arreglo[]=$porcentaje;
      array_push($arreglo, $porcentaje2, $porcentaje3, $porcentaje4,$porcentaje5,$anio,$anio2,$anio3,$anio4,$anio5);

      return json_encode($arreglo);
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
    public function ajax2($id,$periodo,$anio){
      $metas=\DB::select("
      SELECT id_indicador from metas where id_indicador=".$id." and periodo= ".$periodo." and year(metas.created_at)=".$anio."
      ");

      $datos=\DB::select("
      SELECT id_indicador from datos where id_indicador=".$id." and periodo= ".$periodo." and year(datos.created_at)=".$anio."
      ");
      $variable="";
      $anio2=date('Y');

      if ($metas==null) {
        $variable=1;
      }
      if ($datos==null) {
        $variable=1;
      }


      for ($i=0; $i <count($metas) ; $i++) {
        $bandera=false;
        for ($y=0; $y < count($datos); $y++) {
          if ($datos{$y}->id_indicador == $metas{$i}->id_indicador) {
            $bandera=true;
          }
        }
        if ($bandera==false) {
          //no hay
          $variable=1;
        }else {
          //si hay
          $variable=2;
        }


      }
      return $variable;


    }
}
