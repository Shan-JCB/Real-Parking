<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clientes.create');
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
            'dni' => 'required|unique:clientes',
            'placa' => 'required|unique:clientes',
            'correo' => 'required|unique:clientes',
            'celular' => 'required',
            'direccion' => 'required',
        ]);

        $clientes = new Cliente();
        $clientes->nombres = $request->nombres;
        $clientes->apellidos = $request->apellidos;
        $clientes->dni = $request->dni;
        $clientes->placa = $request->placa;
        $clientes->correo = $request->correo;
        $clientes->celular = $request->celular;
        $clientes->direccion = $request->direccion;
        $clientes->save();

        return redirect()->route('admin.clientes.create')
            ->with('mensaje', 'Se registró nuevo cliente!')
            ->with('icono', 'success')
            ->with('titulo', 'Operación Exitosa!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateBasica(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'celular' => 'required',
            'direccion' => 'required',
        ]);

        $cliente->nombres = $request->nombres;
        $cliente->apellidos = $request->apellidos;
        $cliente->celular = $request->celular;
        $cliente->direccion = $request->direccion;
        $cliente->save();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Se actualizó la información básica del cliente')
            ->with('icono', 'success')
            ->with('titulo', 'Operación Exitosa!');
    }

    public function updateRelevante(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        $request->validate([
            'dni' => 'required|unique:clientes,dni,' . $cliente->id,
            'placa' => 'required|unique:clientes,placa,' . $cliente->id,
            'correo' => 'required|unique:clientes,correo,' . $cliente->id,
        ]);

        $cliente->dni = $request->dni;
        $cliente->placa = $request->placa;
        $cliente->correo = $request->correo;
        $cliente->save();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Se actualizó la información relevante del cliente')
            ->with('icono', 'success')
            ->with('titulo', 'Operación Exitosa!');
    }


    public function confirmDelete($id)
    {

        $cliente = Cliente::findOrFail($id);
        return view('admin.clientes.delete', compact('cliente'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Cliente::destroy($id);
        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Se eliminó cliente!')
            ->with('icono', 'success')
            ->with('titulo', 'Operación Exitosa!');
    }

    public function buscarPorPlaca(Request $request)
    {
        $placa = $request->input('placa');
        $cliente = Cliente::where('placa', $placa)->first();

        if ($cliente) {
            return response()->json([
                'status' => 'found',
                'cliente' => $cliente
            ]);
        } else {
            return response()->json([
                'status' => 'not_found',
                'message' => 'El cliente es nuevo'
            ]);
        }
    }
}
