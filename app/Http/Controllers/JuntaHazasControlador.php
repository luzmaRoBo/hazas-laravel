<?php

namespace App\Http\Controllers;

use App\Models\JuntaHaza;

use Illuminate\Http\Request;

class JuntaHazasControlador extends Controller
{

    /** Listado de juntaHazas */
    public function show()
    {
        $juntaHazas = JuntaHaza::paginate(15);
        return view('juntaHazas.show', compact('juntaHazas'));
    }

    /** Mostrar formulario de creación */
    public function create()
    {
        return view('juntaHazas.create', ['junta' => null]);
    }

    /** Guardar nueva juntaHaza */
    public function store(Request $request)
    {
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }

        $validacion = $request->validate([
            'idJuntaHazas'     => 'required|string|max:10|unique:juntaHazas,idJuntaHazas',
            'nombre'           => 'nullable|string|max:30',
            'apellido1'        => 'nullable|string|max:30',
            'apellido2'        => 'nullable|string|max:30',
            'tipoParticipante' => 'nullable|in:alcalde,asociado,concejal',
        ], [
            'idJuntaHazas.max'    => 'El ID no puede tener más de 10 caracteres.',
            'idJuntaHazas.unique' => 'Ese ID ya está registrado.',
        ]);

        $junta = JuntaHaza::create($validacion);

        return redirect()
            ->route('juntaHazas.show')
            ->with('success', "Miembro de Junta {$junta->idJuntaHazas} añadido correctamente.");
    }

    /** Mostrar formulario de edición */
    public function edit(string $idJuntaHazas)
    {
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }

        $junta = JuntaHaza::findOrFail($idJuntaHazas);
        return view('juntaHazas.create', compact('junta'));
    }

    /** Actualizar una juntaHaza existente */
    public function update(Request $request, string $idJuntaHazas)
    {
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }

        $validacion = $request->validate([
            'idJuntaHazas'     => "required|string|max:10|unique:juntaHazas,idJuntaHazas,{$idJuntaHazas},idJuntaHazas",
            'nombre'           => 'nullable|string|max:30',
            'apellido1'        => 'nullable|string|max:30',
            'apellido2'        => 'nullable|string|max:30',
            'tipoParticipante' => 'nullable|in:alcalde,asociado,concejal',
        ], [
            'idJuntaHazas.max'    => 'El ID no puede tener más de 10 caracteres.',
            'idJuntaHazas.unique' => 'Ese ID ya está registrado.',
        ]);

        $junta = JuntaHaza::findOrFail($idJuntaHazas);
        $junta->update($validacion);

        return redirect()
            ->route('juntaHazas.show')
            ->with('success', "Miembro de Junta {$junta->idJuntaHazas} actualizado correctamente.");
    }

    /** Eliminar una juntaHaza existente */
    public function destroy(string $idJuntaHazas)
    {
        $usuario = usuarioActual();

        if (!$usuario || $usuario->rol !== 'root') {
            abort(403, 'No tienes permiso para eliminar.');
        }

        $junta = JuntaHaza::findOrFail($idJuntaHazas);
        $junta->delete();

        return redirect()
            ->route('juntaHazas.show')
            ->with('success', "Miembro de Junta {$junta->idJuntaHazas} eliminado correctamente.");
    }
}
