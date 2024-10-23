<?php

namespace App\Http\Controllers;

use App\Models\Operador;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OperadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $operadores = Operador::with('user')->get();
        return view('admin.operadores.index', compact('operadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.operadores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'dni' => 'required|unique:operadors',
            'celular' => 'required',
            'direccion' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();

        $operador = new Operador();
        $operador->user_id = $usuario->id;
        $operador->nombres = $request->nombres;
        $operador->apellidos = $request->apellidos;
        $operador->dni = $request->dni;
        $operador->celular = $request->celular;
        $operador->direccion = $request->direccion;
        $operador->save();

        return redirect()->route('admin.operadores.index')
            ->with('mensaje', 'Se registró nuevo operador!')
            ->with('icono', 'success')
            ->with('titulo', 'Operación Exitosa!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $operador = Operador::with('user')->findOrFail($id);
        return view('admin.operadores.show', compact('operador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $operador = Operador::with('user')->findOrFail($id);
        return view('admin.operadores.edit', compact('operador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $operador = Operador::find($id);

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'dni' => 'required|unique:operadors,dni,' . $operador->id,
            'celular' => 'required',
            'direccion' => 'required',
            'email' => 'required|unique:users,email,' . $operador->user->id,
            'password' => 'nullable|confirmed',
        ]);

        $operador->nombres = $request->nombres;
        $operador->apellidos = $request->apellidos;
        $operador->dni = $request->dni;
        $operador->celular = $request->celular;
        $operador->direccion = $request->direccion;
        $operador->save();

        $usuario = User::find($operador->user->id);
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();

        return redirect()->route('admin.operadores.index')
            ->with('mensaje', 'Se Actualizó Operador!')
            ->with('icono', 'success')
            ->with('titulo', 'Operación Exitosa!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $operador = Operador::find($id);
        $user = $operador->user;
        $user->delete();
        $operador->delete();

        return redirect()->route('admin.operadores.index')
            ->with('mensaje', 'Se Eliminó Operador!')
            ->with('icono', 'danger')
            ->with('titulo', 'Operación Exitosa!');
    }
}
