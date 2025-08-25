<?php

namespace App\Http\Controllers;

use App\Models\PadronHabitante;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PadronHabitantesControlador extends Controller
{

    /** Listado de habitantes */
    public function show()
    {
        $padronHabitantes = PadronHabitante::paginate(15);
        return view('padronHabitantes.show', compact('padronHabitantes'));
    }

    /** Mostrar formulario de creación */
    public function create()
    {
        return view('padronHabitantes.create', ['habitante' => null]);
    }

    /** Guardar nuevo habitante */
    public function store(Request $request)
    {

        //solo pueden crear root y modificacion
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }

        $validated = $request->validate([
            'idHabitante'       => 'required|string|max:10|unique:padronhabitantes,idHabitante',
            'apellido1'         => 'required|string|max:100',
            'apellido2'         => 'nullable|string|max:100',
            'nombre'            => 'required|string|max:100',
            'domicilioOriginal' => 'nullable|string|max:255',
            'tipoDireccion'     => 'nullable|in:calle,avenida,plaza,carretera,camino,callejon',
            'nombreDireccion'   => 'nullable|string|max:120',
            'numeroDireccion'   => 'nullable|string|max:5',
            'bloqueDireccion'   => 'nullable|string|max:5',
            'escaleraDireccion' => 'nullable|string|max:5',
            'piso'              => 'nullable|string|max:5',
            'puerta'            => 'nullable|string|max:5',
            'codigoPostal'      => 'nullable|string|max:5',
            'excluido'          => 'nullable|boolean',
            'fechaExclusion'    => 'nullable|date',
            'observaciones'     => 'nullable|string',
        ], [
            'idHabitante.max'      => 'El ID de habitante no puede tener más de 10 caracteres',
            'idHabitante.required' => 'El ID del habitante es obligatorio.',
            'idHabitante.unique'   => 'Ese ID ya está registrado.',
            'apellido1.required'   => 'El primer apellido es obligatorio.',
            'nombre.required'      => 'El nombre es obligatorio.',
            'fechaExclusion.date'  => 'La fecha de exclusión debe ser válida.',
        ]);

        $validated['excluido'] = $request->has('excluido');

        PadronHabitante::create($validated);

        return redirect()->route('padronHabitantes.show')->with('success', 'Habitante añadido correctamente.');
    }

    /** Mostrar formulario de edición con los datos */
    public function edit(string $idHabitante)
    {

        //solo pueden pasar a editar root y modificacion
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }

        $habitante = PadronHabitante::findOrFail($idHabitante);
        return view('padronHabitantes.create', compact('habitante'));
    }

    /** Actualizar datos existentes */
    public function update(Request $request, string $idHabitante)
    {
        //solo pueden crear root y modificacion
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }

        $validated = $request->validate([
            'idHabitante' => "required|string|max:10|unique:padronhabitantes,idHabitante,{$idHabitante},idHabitante",
            'apellido1'         => 'required|string|max:100',
            'apellido2'         => 'nullable|string|max:100',
            'nombre'            => 'required|string|max:100',
            'domicilioOriginal' => 'nullable|string|max:255',
            'tipoDireccion'     => 'nullable|in:calle,avenida,plaza,carretera,camino,callejon',
            'nombreDireccion'   => 'nullable|string|max:120',
            'numeroDireccion'   => 'nullable|string|max:5',
            'bloqueDireccion'   => 'nullable|string|max:5',
            'escaleraDireccion' => 'nullable|string|max:5',
            'piso'              => 'nullable|string|max:5',
            'puerta'            => 'nullable|string|max:5',
            'codigoPostal'      => 'nullable|string|max:5',
            'excluido'          => 'nullable|boolean',
            'fechaExclusion'    => 'nullable|date',
            'observaciones'     => 'nullable|string',
        ], [
            'idHabitante.required' => 'El ID del habitante es obligatorio.',
            'idHabitante.unique'   => 'Ese ID ya está registrado.',
            'apellido1.required'   => 'El primer apellido es obligatorio.',
            'nombre.required'      => 'El nombre es obligatorio.',
            'domicilioOriginal.required' => 'El domicilio original es obligatorio.',
            'fechaExclusion.date'  => 'La fecha de exclusión debe ser válida.',
        ]);

        $validated['excluido'] = $request->has('excluido');

        $habitante = PadronHabitante::findOrFail($idHabitante);
        $habitante->update($validated);

        return redirect()->route('padronHabitantes.show')->with('success', "Habitante {$habitante->idHabitante} actualizado correctamente.");
    }

    /** Eliminar habitante */
    public function destroy(string $idHabitante)
    {

        //solo pueden eliminar root
        $usuario = usuarioActual();

        if (!$usuario || $usuario->rol !== 'root') {
            abort(403, 'No tienes permiso para eliminar hazas.');
        }

        $habitante = PadronHabitante::findOrFail($idHabitante);
        $habitante->delete();

        return redirect()->route('padronHabitantes.show')->with('success', "Habitante {$habitante->idHabitante} eliminado correctamente.");
    }
}
