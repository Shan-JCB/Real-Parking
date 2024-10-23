<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Operador;
use App\Models\Pago;
use App\Models\Parqueo;
use App\Models\Tarifa;
use Illuminate\Http\Request;

class ParqueoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $pisoSeleccionado = $request->get('piso', 'PISO 1'); // Piso 1 como predeterminado

        $parqueos = Parqueo::where('piso', $pisoSeleccionado)->get();

        $pisos = ['PISO 1', 'PISO 2', 'PISO 3', 'PISO EXTERIOR']; // Lista de pisos

        $operadors = Operador::all();
        $clientes = Cliente::all();
        $tarifas = Tarifa::all();
        $pagos = Pago::all();

        return view('admin.parqueos.index', compact('parqueos', 
        'pisoSeleccionado', 'pisos', 'operadors', 'tarifas','pagos','clientes'));
    }

    public function buscarClientePorPlaca(Request $request)
    {
        $placa = $request->input('placa');
        $cliente = Cliente::where('placa', $placa)->first();

        if ($cliente) {
            // Retorna la información del cliente en formato JSON si existe
            return response()->json([
                'status' => 'success',
                'cliente' => $cliente,
            ]);
        } else {
            // Retorna un mensaje de error si no se encuentra
            return response()->json([
                'status' => 'error',
                'message' => 'Cliente no encontrado'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.parqueos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required',
            'estado' => 'required',
            'piso' => 'required',
        ]);

        $parqueos = new Parqueo();
        $parqueos->numero = $request->numero;
        $parqueos->estado = $request->estado;
        $parqueos->piso = $request->piso;
        $parqueos->observacion = $request->observacion;
        $parqueos->save();

        return redirect()->route('admin.parqueos.index')
            ->with('mensaje', 'Se registró nuevo espacio!')
            ->with('icono', 'success')
            ->with('titulo', 'Operación Exitosa!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $parqueo = Parqueo::findOrFail($id);
        return view('admin.parqueos.edit', compact('parqueo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $parqueo = Parqueo::find($id);

        $request->validate([
            'numero' => 'required',
            'estado' => 'required',
            'piso' => 'required',
        ]);

        $parqueo->numero = $request->numero;
        $parqueo->estado = $request->estado;
        $parqueo->piso = $request->piso;
        $parqueo->observacion = $request->observacion;
        $parqueo->save();

        return redirect()->route('admin.parqueos.index')
            ->with('mensaje', 'Se Actualizò Espacio!')
            ->with('icono', 'success')
            ->with('titulo', 'Operación Exitosa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parqueo $parqueo)
    {
        //
    }
}
