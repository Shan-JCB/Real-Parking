<?php

namespace App\Http\Controllers;

use App\Models\Parqueo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $pisoSeleccionado = $request->get('piso', 'PISO 1'); // Piso 1 como predeterminado
    
        $parqueos = Parqueo::where('piso', $pisoSeleccionado)->get();
    
        $pisos = ['PISO 1', 'PISO 2', 'PISO 3', 'PISO EXTERIOR']; // Lista de pisos
        return view('/home', compact('parqueos', 'pisoSeleccionado', 'pisos'));
    }
}
