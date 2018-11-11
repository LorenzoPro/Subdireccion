<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ReportesController extends Controller
{
    //
    public function index($id,$periodo,$anio){
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
      $nombreIndicador=\DB::select("
      select nombre from indicadores where id_indicador=".$id."
      ");

      $nombreArea=\DB::select("
      select area from indicadores where id_indicador=".$id."
      ");

      $nombreObjetivo=\DB::select("
      select objetivo from indicadores where id_indicador=".$id."
      ");

      $variable=\DB::select("
        select variable1, variable2 from indicadores where id_indicador=".$id."
      ");

      $meta =\DB::select("
      SELECT meta  FROM metas
      INNER JOIN datos on datos.id_indicador = metas.id_indicador
      and metas.periodo=".$periodo." and datos.periodo=".$periodo."
      and datos.id_indicador=".$id." and Year(datos.created_at)=".$anio."
      ");

      $tendencia =\DB::select("
      SELECT tendencia  FROM metas
      INNER JOIN datos on datos.id_indicador = metas.id_indicador
      and metas.periodo=".$periodo." and datos.periodo=".$periodo."
      and datos.id_indicador=".$id." and Year(datos.created_at)=".$anio."
      ");

      $nombres1="";
      $nombres1=$nombres1 . '' .$nombreIndicador{0}->nombre.'';

      $nombreArea1="";
      $nombreArea1=$nombreArea1 . '' .$nombreArea{0}->area.'';

      $nombreObjetivo1="";
      $nombreObjetivo1=$nombreObjetivo1 . '' .$nombreObjetivo{0}->objetivo.'';

      $meta1="";
      $meta1=$meta1 . '' . $meta{0}->meta.'';

      $tendencia1="";
      $tendencia1=$tendencia1 . '' . $tendencia{0}->tendencia.'';

      $TotaldeHombres="";
      $TotaldeHombres=$TotaldeHombres . '' .$hombres{0}->suma.'';

      $TotaldeHombres2="";
      $TotaldeHombres2=$TotaldeHombres2 . '' .$hombres2{0}->suma2.'';

      $TotaldeMujeres="";
      $TotaldeMujeres=$TotaldeMujeres . '' .$mujeres{0}->suma.'';

      $TotaldeMujeres2="";
      $TotaldeMujeres2=$TotaldeMujeres2 . '' .$mujeres2{0}->suma2.'';



      //return($nombres1);
      //dd($nombres1);
     return view('reportes.reporte')
        ->with('nombres',json_encode($nombres1))
        ->with('area',json_encode($nombreArea1))
        ->with('objetivo',json_encode($nombreObjetivo1))
        ->with('meta',json_encode($meta1))
        ->with('carreras', $carrerasV11)
        ->with('tendencia',json_encode($tendencia1))
        ->with('hombres',json_encode($TotaldeHombres))
        ->with('hombres2',json_encode($TotaldeHombres2))
        ->with('mujeres',json_encode($TotaldeMujeres))
        ->with('mujeres2',json_encode($TotaldeMujeres2));




  /*$pdf = PDF::loadView('reportes.reporte');
      return $pdf->stream();*/


    }
}
