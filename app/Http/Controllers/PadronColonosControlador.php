<?php

namespace App\Http\Controllers;

use App\Models\PadronColono;
use App\Models\PadronHabitante;
use App\Models\JuntaHaza;

use Illuminate\Http\Request;

class PadronColonosControlador extends Controller
{
    //funcion para listar los datos
    public function show()
    {

        $padronColonos = PadronColono::paginate(15);
        return view('padronColonos.show', compact('padronColonos'));
    }

    public function create()
    {

        $habitantes = PadronHabitante::all(); // para select de idHabitante
        $juntas = JuntaHaza::all(); // para select de idJuntaHazas

        return view('padronColonos.create', [
            'colono' => null,
            'habitantes' => $habitantes,
            'juntas' => $juntas
        ]);
    }

    /** Guardar nuevo colono */
    public function store(Request $request)
    {
        //solo pueden crear root y modificacion
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }
        // validación de datos
        $validacion = $request->validate([
            'idColono'          => 'required|string|max:10|unique:padroncolonos,idColono',
            'apellido1'         => 'nullable|string|max:30',
            'apellido2'         => 'nullable|string|max:30',
            'nombre'            => 'nullable|string|max:30',
            'apodo'             => 'nullable|string|max:30',
            'dni'               => 'nullable|string|max:10',
            'telefono'          => 'nullable|string|max:10',
            'email'             => 'nullable|email|max:40',
            'idJuntaHazas'      => 'nullable|string|max:10|exists:juntahazas,idJuntaHazas',
            'idHabitante'       => 'nullable|string|max:10|exists:padronhabitantes,idHabitante',
            'tipoDireccion'     => 'nullable|in:calle,avenida,plaza,carretera,camino,callejon',
            'nombreDireccion'   => 'nullable|string|max:10',
            'numeroDireccion'   => 'nullable|string|max:10',
            'bloqueDireccion'   => 'nullable|string|max:10',
            'escaleraDireccion' => 'nullable|string|max:10',
            'piso'              => 'nullable|string|max:10',
            'puerta'            => 'nullable|string|max:10',
            'codigoPostal'      => 'nullable|string|max:10',
        ], [
            'idColono.max'          => 'El ID del colono no puede tener más de 10 caracteres.',
            'idColono.unique'       => 'Ese ID ya está registrado.',
            'idJuntaHazas.exists'   => 'El ID de juntaHazas no existe.',
            'idHabitante.exists'    => 'El ID de habitante no existe.',
        ]);

        // creación y redirección
        $colono = PadronColono::create($validacion);

        return redirect()
            ->route('colonos.show')
            ->with('success', "Colono {$colono->idColono} añadido correctamente.");
    }

    /** Mostrar formulario de edición */
    public function edit(string $idColono)
    {
        //solo pueden pasar a editar root y modificacion
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }

        $colono = PadronColono::findOrFail($idColono);
        $habitantes = PadronHabitante::all();
        $juntas = JuntaHaza::all();

        return view('padronColonos.create', compact('colono', 'habitantes', 'juntas'));
    }

    /** Borrar colono existente */
    public function destroy(string $idColono)
    {
        //solo pueden eliminar root
        $usuario = usuarioActual();

        if (!$usuario || $usuario->rol !== 'root') {
            abort(403, 'No tienes permiso para eliminar hazas.');
        }

        $colono = PadronColono::findOrFail($idColono);
        $colono->delete();

        return redirect()
            ->route('colonos.show')
            ->with('success', "Colono {$colono->idColono} eliminado correctamente.");
    }

    /** Actualizar colono existente */
    public function update(Request $request, string $idColono)
    {
        //solo pueden crear root y modificacion
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }

        // validación de datos
        $validacion = $request->validate([
            'idColono'          => "required|string|max:10|unique:padroncolonos,idColono,{$idColono},idColono",
            'apellido1'         => 'nullable|string|max:30',
            'apellido2'         => 'nullable|string|max:30',
            'nombre'            => 'nullable|string|max:30',
            'apodo'             => 'nullable|string|max:30',
            'dni'               => 'nullable|string|max:10',
            'telefono'          => 'nullable|string|max:10',
            'email'             => 'nullable|email|max:40',
            'idJuntaHazas'      => 'nullable|string|max:10|exists:juntahazas,idJuntaHazas',
            'idHabitante'       => 'nullable|string|max:10|exists:padronhabitantes,idHabitante',
            'tipoDireccion'     => 'nullable|in:calle,avenida,plaza,carretera,camino,callejon',
            'nombreDireccion'   => 'nullable|string|max:10',
            'numeroDireccion'   => 'nullable|string|max:10',
            'bloqueDireccion'   => 'nullable|string|max:10',
            'escaleraDireccion' => 'nullable|string|max:10',
            'piso'              => 'nullable|string|max:10',
            'puerta'            => 'nullable|string|max:10',
            'codigoPostal'      => 'nullable|string|max:10',
        ], [
            'idColono.max'          => 'El ID del colono no puede tener más de 10 caracteres.',
            'idColono.unique'       => 'Ese ID ya está registrado.',
            'idJuntaHazas.exists'   => 'El ID de juntaHazas no existe.',
            'idHabitante.exists'    => 'El ID de habitante no existe.',
        ]);

        // actualización
        $colono = PadronColono::findOrFail($idColono);
        $colono->update($validacion);

        return redirect()
            ->route('colonos.show')
            ->with('success', "Colono {$colono->idColono} actualizado correctamente.");
    }
}
