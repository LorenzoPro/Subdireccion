<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ReportesController extends Controller
{
    //
    public function index(){
      /*//SUMA DE LA COLUMNA DE HOMBRES
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
      }//llave del for

      //TOTAL DE porcentajes CON SUS ANIOS
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

      //NOMBRE Y VARIABLES DE Indicadores
      $nombre=\DB::select("
      select nombre from indicadores where id_indicador=".$id."
      ");

      $variable=\DB::select("
        select variable1, variable2 from indicadores where id_indicador=".$id."
      ");*/

      $pdf = PDF::loadView('welcome');
      return $pdf->stream();


    }
}
