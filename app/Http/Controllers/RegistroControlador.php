<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RegistroControlador extends Controller
{
    public function registro()
    {

        return view('login.registro');
    }

    // Procesa el formulario de registro
    public function store(Request $request)
    {
        //compruebo que no sea un usuario ya registrado
        if (\App\Models\Usuarios::where('usuario', $request->usuario)->exists()) {
            return redirect()
                ->route('login')
                ->with('error', 'El usuario ya está registrado. Por favor, inicia sesión.');
        }

        //valido los datos
        $validated = $request->validate([
            'usuario' => 'required|string|max:50|unique:usuarios,usuario',
            'pass'    => 'required|string',
        ]);

        //creo el nuevo usuario
        $user = new Usuarios();
        $user->idUsuario = Str::random(10);
        $user->usuario   = $validated['usuario'];
        $user->pass      = Hash::make($validated['pass']);
        $user->rol       = 'lectura';
        $user->save();

        //redirijo al login con el mensaje 
        return redirect()
            ->route('login')
            ->with('success', 'Registro completado. Ahora inicia sesión.');
    }
}
