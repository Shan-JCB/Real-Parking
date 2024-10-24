<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use App\Models\Operador;
use App\Models\Pago;
use App\Models\Parqueo;
use App\Models\Tarifa;
use Illuminate\Http\Request;

class AdminController extends Controller
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

    public function index(){
        $total_usuarios = User::count();
        $total_operadores = Operador::count();
        $total_clientes = Cliente::count();
        $total_parqueos = Parqueo::count();
        $total_pagos = Pago::count();
        $total_tarifas = Tarifa::count();
        return view('admin.index', 
        compact('total_usuarios', 'total_operadores',
                'total_clientes', 'total_parqueos', 
                'total_pagos', 'total_tarifas'));

    }
}
