<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;

class UserController extends Controller
{
  //Checar si esta logeado
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index(){
    //Consulta directamente a la tabla
      $usuarios=\DB::table('users')
        //->where('id','=','1')
        //->take(10);
        ->orderBy('id','name')
        ->get();
      $titulo = "ITSNCG - Usuarios";
      return view('admin.usuarios')
        ->with('titulo', $titulo)
        ->with('usuarios', $usuarios);
  }
}
