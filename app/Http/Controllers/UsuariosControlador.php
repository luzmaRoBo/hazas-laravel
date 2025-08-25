<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosControlador extends Controller
{

    /**Listado de usuarios */
    public function show()
    {
        $usuarios = Usuarios::paginate(15);
        return view('usuarios.show', compact('usuarios'));
    }

    /** Mostrar formulario de creación */
    public function create()
    {
        return view('usuarios.create', ['usuario' => null]);
    }

    /** Guardar nuevo usuario */
    public function store(Request $request)
    {
        //solo pueden crear root y modificacion
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }

        // validamos los datos
        $data = $request->validate([
            // 'idUsuario' => 'required|string|max:10|unique:usuarios,idUsuario',
            'usuario'   => 'required|string|max:50|unique:usuarios,usuario',
            'pass'      => 'required|string|max:255',
            'rol'       => 'nullable|in:root,lectura,modificación',
        ], [
            // 'idUsuario.max'    => 'El ID de usuario no puede tener más de 10 caracteres.',
            // 'idUsuario.unique' => 'Ese ID ya está registrado.',
            'usuario.max'      => 'El nombre de usuario no puede tener más de 50 caracteres.',
            'usuario.unique'   => 'Ese nombre de usuario ya existe.',
        ]);

        // hasheamos la contraseña
        $data['pass'] = Hash::make($data['pass']);

        // creamos el usuario y redirigimos
        $usuario = Usuarios::create($data);

        return redirect()
            ->route('usuarios.show')
            ->with('success', "Usuario {$usuario->idUsuario} añadido correctamente.");
    }

    /** Mostrar formulario de edición */
    public function edit(string $idUsuario)
    {
        //solo pueden pasar a editar root y modificacion
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }

        $usuario = Usuarios::findOrFail($idUsuario);
        return view('usuarios.create', compact('usuario'));
    }

    /** Actualizar usuario existente */
    public function update(Request $request, string $idUsuario)
    {
        //solo pueden pasar a editar root y modificacion
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }

        // validamos los datos
        $data = $request->validate([
            // 'idUsuario' => "required|string|max:10|unique:usuarios,idUsuario,{$idUsuario},idUsuario",
            'usuario'   => "required|string|max:50|unique:usuarios,usuario,{$idUsuario},idUsuario",
            'pass'      => 'nullable|string|max:255',
            'rol'       => 'nullable|in:root,lectura,modificación',
        ], [
            // 'idUsuario.max'    => 'El ID de usuario no puede tener más de 10 caracteres.',
            // 'idUsuario.unique' => 'Ese ID ya está registrado.',
            'usuario.max'      => 'El nombre de usuario no puede tener más de 50 caracteres.',
            'usuario.unique'   => 'Ese nombre de usuario ya existe.',
        ]);

        // hasheamos la contraseña
        if ($request->filled('pass')) {
            $data['pass'] = Hash::make($data['pass']);
        } else {
            unset($data['pass']);
        }

        // recuperamos la instancia y actualizamos
        $usuario = Usuarios::findOrFail($idUsuario);
        $usuario->update($data);

        return redirect()
            ->route('usuarios.show')
            ->with('success', "Usuario {$usuario->idUsuario} actualizado correctamente.");
    }

    /** Borrar usuario existente */
    public function destroy(string $idUsuario)
    {
        //solo pueden eliminar root
        $usuario = usuarioActual();

        if (!$usuario || $usuario->rol !== 'root') {
            abort(403, 'No tienes permiso para eliminar hazas.');
        }

        $usuario = Usuarios::findOrFail($idUsuario);
        $usuario->delete();

        return redirect()
            ->route('usuarios.show')
            ->with('success', "Usuario {$usuario->idUsuario} eliminado correctamente.");
    }
}
