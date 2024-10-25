<?php

namespace App\Http\Controllers;

use App\Mail\ContactanosMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactanosController extends Controller
{
    public function index(){

        $user = auth()->user(); // Obtiene el usuario autenticado
        return view('contactanos.index', compact('user'));

    }

    public function store(Request $request){

        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email',
            'mensaje' => 'required'
        ]);

        Mail::to('admin@real.net')->send(new ContactanosMailable($request->all()));

        //Metodo para declarar un mensaje de forma momentanea
        return redirect()->route('contactanos.index')->with('info', 'Mensaje Enviado');
    }
}
