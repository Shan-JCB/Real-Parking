<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'usuario' => 'required|string',
            'password_user' => 'required|string',
        ]);

        $usuario = $request->input('usuario');
        $password_user = $request->input('password_user');

        // Aquí puedes agregar la lógica para verificar las credenciales
        if($usuario === 'home' && $password_user === 'password123') {
            return redirect()->route('dashboard')->with('success', 'Login correcto');
        } else {
            return back()->withErrors(['credentials' => 'Credenciales incorrectas']);
        }
    }
}
