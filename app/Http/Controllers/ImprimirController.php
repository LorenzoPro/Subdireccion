<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ImprimirController extends Controller
{
    //
    public function index(){
      $pdf = PDF::loadView('reportes.reporte');
         return $pdf->stream();
    }
}
