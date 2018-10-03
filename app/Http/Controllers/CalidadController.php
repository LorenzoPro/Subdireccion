<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

      return view('admin.calidad')
        ->with('indicadores', $indicador);
    }
}
