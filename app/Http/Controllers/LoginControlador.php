<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginControlador extends Controller
{
    public function login(){

        return view('login.login'); 
    }

    public function loginCreate(Request $request)
    {
        //  validamos los campos pra que sean string
        $data = $request->validate([
            'usuario' => 'required|string',
            'pass'    => 'required|string',
        ]);

        // comprobamos si hay usuario registrado
        $user = Usuarios::where('usuario', $data['usuario'])->first();
        if (! $user) {
            return redirect()->route('registro')
                             ->with('error', 'Usuario no encontrado. Regístrate.');
        }

        // Verificamos la contraseña
        if (! Hash::check($data['pass'], $user->pass)) {
            return back()
                ->withErrors(['pass' => 'Contraseña incorrecta'])
                ->withInput(['usuario' => $data['usuario']]);
        }

        //  Guardamos la sesión en sesións que viene por defecto en laravel
        session([
            'usuario_id'  => $user->idUsuario,
            'usuario_rol' => $user->rol,
        ]);

        //  Redirijo al programa en la pagina de inicio
        return redirect()->route('inicio');
    }

    // cerrar sesión
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}
