<?php

namespace App\Http\Controllers;

use App\Models\Tarifa;
use Illuminate\Http\Request;

class TarifaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarifas = Tarifa::all();
        return view('admin.tarifas.index', compact('tarifas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tarifas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'monto' => 'required|numeric|min:0',
            'periodo' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
        ]);

        $tarifa = new Tarifa();
        $tarifa->nombre = $request->nombre;
        $tarifa->monto = $request->monto;
        $tarifa->periodo = $request->periodo;
        $tarifa->descripcion = $request->descripcion;
        $tarifa->save();

        return redirect()->route('admin.tarifas.index')
            ->with('mensaje', 'Se registró nueva Tarifa!')
            ->with('icono', 'success')
            ->with('titulo', 'Operación Exitosa!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tarifa = Tarifa::findOrFail($id);
        return view('admin.tarifas.edit', compact('tarifa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tarifa = Tarifa::find($id);

        $request->validate([
            'nombre' => 'required',
            'monto' => 'required|numeric|min:0',
            'periodo' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
        ]);

        $tarifa->nombre = $request->nombre;
        $tarifa->monto = $request->monto;
        $tarifa->periodo = $request->periodo;
        $tarifa->descripcion = $request->descripcion;
        $tarifa->save();

        return redirect()->route('admin.tarifas.index')
            ->with('mensaje', 'Se actualizó Tarifa!')
            ->with('icono', 'success')
            ->with('titulo', 'Operación Exitosa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tarifa = Tarifa::find($id);
        $tarifa->delete();

        return redirect()->route('admin.tarifas.index')
            ->with('mensaje', 'Se Eliminó Operador!')
            ->with('icono', 'success')
            ->with('titulo', 'Operación Exitosa!');
    }
}
