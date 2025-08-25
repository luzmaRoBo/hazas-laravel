<?php

namespace App\Http\Controllers;

use App\Models\Haza;

use Illuminate\Http\Request;

class HazasControlador extends Controller
{

    /**Listado de hazas */
    public function show()
    {
        $hazas = Haza::paginate(15);
        return view('hazas.show', compact('hazas'));
    }

    /** Mostrar formulario de creación */
    public function create()
    {

        // siempre vendrá $haza = null
        return view('hazas.create', ['haza' => null]);
    }

    /**Guardar nueva haza */
    public function store(Request $request)
    {
        //solo pueden crear root y modificacion
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }

        //primero validamos los datos
        $validacion = $request->validate([
            'idHaza'       => 'required|string|max:15|unique:hazas,idHaza',
            'nHaza'        => 'required|string|max:10',
            'partido'      => 'nullable|in:Manzanete,Bujar,Marmosilla,Algar,Cantarranas,Compradizas,El Águila,Las Corderas',
            'hectareas'    => 'nullable|numeric',
            'rentaAnual'   => 'nullable|numeric',
            'uso'          => 'nullable|in:Cultivo,Arrendamiento,Venta,Militar',
            'localizacion' => 'nullable|string|max:50',
            'caballerizas' => 'nullable|string|max:50',
            'fechaInicio'  => 'nullable|date',
            'fechaFin'     => 'nullable|date|after_or_equal:fechaInicio',
        ], [
            'idHaza.max'         => 'El ID de la haza no puede tener más de 15 caracteres.',
            'idHaza.unique'      => 'Ese ID ya está registrado.',
            'nHaza.max'          => 'El Numero de la haza no puede tener más de 10 caracteres.',
        ]);
        //creamos la nueva haza y redirigimos 
        $haza = Haza::create($validacion);

        return redirect()
            ->route('hazas.show')
            ->with('success', "Haza {$haza->idHaza} añadida correctamente.");
    }
    //pasar los datos de un haza al formulario
    public function edit(string $idHaza)
    {
        //solo pueden pasar a editar root y modificacion
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }
        // Buscamos la Haza 
        $haza = Haza::findOrFail($idHaza);

        // Reutilizamos la vista de creación, pero pasándole $haza
        return view('hazas.create', compact('haza'));
    }

    /**Borrar haza existente */
    public function destroy(string $idHaza)
    {
        //solo pueden eliminar root
        $usuario = usuarioActual();

        if (!$usuario || $usuario->rol !== 'root') {
            abort(403, 'No tienes permiso para eliminar hazas.');
        }

        $haza = Haza::findOrFail($idHaza);
        $haza->delete();

        return redirect()
            ->route('hazas.show')
            ->with('success', "Haza {$haza->idHaza} eliminada correctamente.");
    }

    //actualizamos un haza existente
    public function update(Request $request, string $idHaza)
    {

        //solo pueden crear root y modificacion
        $usuario = usuarioActual();

        if (!$usuario || !in_array($usuario->rol, ['root', 'modificación'])) {
            abort(403, 'No tienes permiso para acceder a esta función.');
        }
        //primero validamos los datos
        $validacion = $request->validate([
            'idHaza'       => "required|string|max:15|unique:hazas,idHaza,{$idHaza},idHaza",
            'nHaza'        => 'required|string|max:10',
            'partido'      => 'nullable|in:Manzanete,Bujar,Marmosilla,Algar,Cantarranas,Compradizas,El Águila,Las Corderas',
            'hectareas'    => 'nullable|numeric',
            'rentaAnual'   => 'nullable|numeric',
            'uso'          => 'nullable|in:Cultivo,Arrendamiento,Venta,Militar',
            'localizacion' => 'nullable|string|max:50',
            'caballerizas' => 'nullable|string|max:50',
            'fechaInicio'  => 'nullable|date',
            'fechaFin'     => 'nullable|date|after_or_equal:fechaInicio',
        ], [
            'idHaza.max'         => 'El ID de la haza no puede tener más de 15 caracteres.',
            'idHaza.unique'      => 'Ese ID ya está registrado.',
            'nHaza.max'          => 'El Numero de la haza no puede tener más de 10 caracteres.',
        ]);

        // Recupera la instancia y actualiza
        $haza = Haza::findOrFail($idHaza);
        $haza->update($validacion);

        return redirect()
            ->route('hazas.show')
            ->with('success', "Haza {$haza->idHaza} actualizada correctamente.");
    }
}
