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
      SELECT carreras.nombre as nombres, datos.hombres,datos.mujeres, datos.hombres2, datos.mujeres2,
      ((datos.hombres+datos.mujeres)/(datos.hombres2+datos.mujeres2))*100 as desglose
      from datos
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
      $valores5="";

      for($i = 0; $i<count($carrerasV11); $i++){
        $carrerasV1 = $carrerasV1 . '"' .$carrerasV11{$i}->nombres.'",';
        $valores1 = $valores1 . $carrerasV11{$i}->hombres.',';
        $valores2 = $valores2 . $carrerasV11{$i}->mujeres.',';
        $valores3 = $valores3 . $carrerasV11{$i}->hombres2.',';
        $valores4 = $valores4 . $carrerasV11{$i}->mujeres2.',';
        $valores5 = $valores5 . $carrerasV11{$i}->desglose.',';
      }//llave del for
      if ($carrerasV11==null) {
        $valores1=0;
        $valores2=0;
        $valores3=0;
        $valores4=0;
        $valores5=0;
      }

      //TOTAL DE porcentajes CON SUS ANIOS
      $anio2=$anio-1;
      $anio3=$anio2-1;
      $anio4=$anio3-1;
      $anio5=$anio4-1;
      $porcentaje=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =0 and year(datos.created_at)=".$anio."
      ");

      $porcentaje2=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =0 and year(datos.created_at)=".$anio2."
      ");
      $porcentaje3=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =0 and year(datos.created_at)=".$anio3."
      ");
      $porcentaje4=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =0 and year(datos.created_at)=".$anio4."
      ");
      $porcentaje5=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =0 and year(datos.created_at)=".$anio5."
      ");

      $porcentaje11=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =1 and year(datos.created_at)=".$anio."
      ");
      $porcentaje22=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =1 and year(datos.created_at)=".$anio2."
      ");
      $porcentaje33=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =1 and year(datos.created_at)=".$anio3."
      ");
      $porcentaje44=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =1 and year(datos.created_at)=".$anio4."
      ");
      $porcentaje55=\DB::select("
        SELECT ((SUM(hombres)+sum(mujeres))/(sum(hombres2)+sum(mujeres2)))*100 as Porcentaje
        from datos where id_indicador=".$id." and periodo =1 and year(datos.created_at)=".$anio5."
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

      $estrategias =\DB::select("
      SELECT estrategias  FROM estrategias
      INNER JOIN datos on datos.id_indicador = estrategias.id_indicador
      and estrategias.periodo=".$periodo." and datos.periodo=".$periodo."
      and datos.id_indicador=".$id." and Year(datos.created_at)=".$anio."
      LIMIT 1
      ");
      $observaciones =\DB::select("
      SELECT observaciones  FROM estrategias
      INNER JOIN datos on datos.id_indicador = estrategias.id_indicador
      and estrategias.periodo=".$periodo." and datos.periodo=".$periodo."
      and datos.id_indicador=".$id." and Year(datos.created_at)=".$anio."
      LIMIT 1
      ");

      if ($estrategias==null) {
        $estrategias="";
      }
      if ($observaciones==null) {
        $observaciones="";
      }



      $nombres1="";
      $nombres1=$nombres1 . '' .$nombreIndicador{0}->nombre.'';

      $variable1="";
      $variable1=$variable1 . '' . $variable{0}->variable1.'';

      $variable2="";
      $variable2=$variable1 . '' . $variable{0}->variable2.'';


      $nombreArea1="";
      $nombreArea1=$nombreArea1 . '' .$nombreArea{0}->area.'';

      $nombreObjetivo1="";
      $nombreObjetivo1=$nombreObjetivo1 . '' .$nombreObjetivo{0}->objetivo.'';

      $meta1="";
      for($i = 0; $i<count($meta); $i++){
        $meta1=$meta1 . '' . $meta{0}->meta.'';
      }

      $tendencia1="";
      for($i = 0; $i<count($tendencia); $i++){
        $tendencia1=$tendencia1 . '' . $tendencia{0}->tendencia.'';
      }


      $TotaldeHombres="";
      $TotaldeHombres=$TotaldeHombres . '' .$hombres{0}->suma.'';

      $TotaldeHombres2="";
      $TotaldeHombres2=$TotaldeHombres2 . '' .$hombres2{0}->suma2.'';

      $TotaldeMujeres="";
      $TotaldeMujeres=$TotaldeMujeres . '' .$mujeres{0}->suma.'';

      $TotaldeMujeres2="";
      $TotaldeMujeres2=$TotaldeMujeres2 . '' .$mujeres2{0}->suma2.'';

      $TotalVariable1="";
      $TotalVariable1=$TotalVariable1 . '' .$totalV1{0}->totalV1.'';

      $TotalVariable2="";
      $TotalVariable2=$TotalVariable2 . '' .$totalV2{0}->totalV2.'';

      $porcentajeFinal1="";
      $porcentajeFinal1=$porcentajeFinal1 . '' . $porcentaje{0}->Porcentaje.'';

      $porcentajeFinal2="";
      $porcentajeFinal2=$porcentajeFinal2 . '' . $porcentaje2{0}->Porcentaje.'';

      $porcentajeFinal3="";
      $porcentajeFinal3=$porcentajeFinal3 . '' . $porcentaje3{0}->Porcentaje.'';

      $porcentajeFinal4="";
      $porcentajeFinal4=$porcentajeFinal4 . '' . $porcentaje4{0}->Porcentaje.'';

      $porcentajeFinal5="";
      $porcentajeFinal5=$porcentajeFinal5 . '' . $porcentaje5{0}->Porcentaje.'';

      $porcentajeFinaldic1="";
      $porcentajeFinaldic1=$porcentajeFinaldic1 . '' . $porcentaje11{0}->Porcentaje.'';

      $porcentajeFinaldic2="";
      $porcentajeFinaldic2=$porcentajeFinaldic2 . '' . $porcentaje22{0}->Porcentaje.'';

      $porcentajeFinaldic3="";
      $porcentajeFinaldic3=$porcentajeFinaldic3 . '' . $porcentaje33{0}->Porcentaje.'';

      $porcentajeFinaldic4="";
      $porcentajeFinaldic4=$porcentajeFinaldic4 . '' . $porcentaje44{0}->Porcentaje.'';

      $porcentajeFinaldic5="";
      $porcentajeFinaldic5=$porcentajeFinaldic5 . '' . $porcentaje55{0}->Porcentaje.'';

      if ($porcentajeFinal2==null) {
        $porcentajeFinal2=0;
        $porcentajeFinal3=0;
        $porcentajeFinal4=0;
        $porcentajeFinal5=0;
      }
      if ($porcentajeFinaldic1==null) {
        $porcentajeFinaldic1=0;
        $porcentajeFinaldic2=0;
        $porcentajeFinaldic3=0;
        $porcentajeFinaldic4=0;
        $porcentajeFinaldic5=0;
      }





      //return($nombres1);
      //dd($nombres1);
     return view('reportes.reporte')
        ->with('nombres',json_encode($nombres1))
        ->with('area',json_encode($nombreArea1))
        ->with('variable1',json_encode($variable1))
        ->with('variable2',json_encode($variable2))
        ->with('TotalVariable1',json_encode($TotalVariable1))
        ->with('TotalVariable2',json_encode($TotalVariable2))
        ->with('porcentajeFinal1',json_encode($porcentajeFinal1))
        ->with('porcentajeFinal2',json_encode($porcentajeFinal2))
        ->with('porcentajeFinal3',json_encode($porcentajeFinal3))
        ->with('porcentajeFinal4',json_encode($porcentajeFinal4))
        ->with('porcentajeFinal5',json_encode($porcentajeFinal5))
        ->with('porcentajeFinaldic1',json_encode($porcentajeFinaldic1))
        ->with('porcentajeFinaldic2',json_encode($porcentajeFinaldic2))
        ->with('porcentajeFinaldic3',json_encode($porcentajeFinaldic3))
        ->with('porcentajeFinaldic4',json_encode($porcentajeFinaldic4))
        ->with('porcentajeFinaldic5',json_encode($porcentajeFinaldic5))
        ->with('objetivo',json_encode($nombreObjetivo1))
        ->with('meta',json_encode($meta1))
        ->with('anio',json_encode($anio))
        ->with('anio2',json_encode($anio2))
        ->with('anio3',json_encode($anio3))
        ->with('anio4',json_encode($anio4))
        ->with('anio5',json_encode($anio5))
        ->with('carreras', $carrerasV11)
        ->with('tendencia',json_encode($tendencia1))
        ->with('estrategias',json_encode($estrategias))
        ->with('observaciones',json_encode($observaciones))
        ->with('hombres',json_encode($TotaldeHombres))
        ->with('hombres2',json_encode($TotaldeHombres2))
        ->with('mujeres',json_encode($TotaldeMujeres))
        ->with('mujeres2',json_encode($TotaldeMujeres2));




  /*$pdf = PDF::loadView('reportes.reporte');
      return $pdf->stream();*/


    }
}
