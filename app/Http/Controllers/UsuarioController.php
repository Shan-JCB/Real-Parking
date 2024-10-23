<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all();

        return view('admin.usuarios.index',['usuarios'=>$usuarios]);
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $request->validate([
            'name' => 'required|max:100',
            'email'=> 'required|unique:users',
            'password'=> 'required|confirmed',
        ]);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();
        return redirect()->route('usuarios.index')
        ->with('mensaje','Se registró nuevo usuario!')
        ->with('icono','success')
        ->with('titulo','Operación Exitosa!');
    }

    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.show', ['usuario'=>$usuario]);
    }

    public function edit($id){

        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', ['usuario'=>$usuario]);
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required|max:100',
            'email'=> 'required|unique:users',
            'password'=> 'required|confirmed',
        ]);

        $usuario = User::find($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();
        return redirect()->route('usuarios.index')
        ->with('mensaje','Se guardaron los cambios!')
        ->with('icono','success')
        ->with('titulo','Operación Exitosa!');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('usuarios.index')
        ->with('mensaje','Usuario eliminado!')
        ->with('icono','success')
        ->with('titulo','Operación Exitosa!');
    }

}
