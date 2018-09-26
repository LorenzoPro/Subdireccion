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
  public function store(Request $req){
    $validator = Validator::make($req->all(),[
      'nombre'=>'required|max:255',
      'correo'=>'required|email',
      'contrasena1'=>'required|max:255',
      'contrasena2'=>'required|max:255',
      /*'imagen'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'*/
      'privilegios'=>'required'
    ]);

    if($validator->fails()){
      //si el validador fallo quiere decir que no esta correcto
      return redirect('/administracion/usuarios')
        ->withInput()
        ->withErrors($validator);
    }else{
      //el punto es para concatenar
      /*$nombreImagen=time() . '.' . $req->imagen->getClientOriginalExtension();
      $req->imagen->move(public_path('/img/usuarios'),$nombreImagen);*/


      //Insertamos, en esta parte User es la clase del modelo User
      //-> es como el . en java $req.nombre == $req->nombre y el => se usa cuando estamos en un arreglo
      User::create([
        'name'=>$req->nombre,
        'email'=>$req->correo,
        'password'=>bcrypt($req->contrasena1),
        //'imagen'=>nombreImagen,
        'privilegios'=>$req->privilegios
      ]);
      return redirect()->to('/administracion/usuarios')
        ->with('mensaje','Usuario Agregado');

    }

  }

  public function edit(Request $req){
    //Select * from..........
    $usuario=User::find($req->id);
    $usuario->name=$req->nameEditar;
    $usuario->email=$req->nameEmail;
    $usuario->privilegios=$req->editarPrivilegios;
    $usuario->save();
    return redirect('/administracion/usuarios/')
      ->with('mensaje','Usuario Actualizado');
  }//llave editar

  public function destroy($id){
    //Consulta directamente al modelo, usaremos este manera para borrar las imagenes
    $usuario = User::find($id);
    $usuario->delete();
    return redirect('/administracion/usuarios/');

    /*if(file_exists(public_path('/img/usuarios/' . $usuario->img_perfil))){
      unlink(public_path('/img/usuarios/' . $usuario->img_perfil))
    }
    $usuario->delete();
    return redirect('/admin/usuarios/ . $usuario-?img_perfil');

    dd($usuario->img_perfil)*/

    //imprime el id pa ver si si jala
    //dd($id);
  }
}
