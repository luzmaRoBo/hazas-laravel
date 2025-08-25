<?php

use App\Models\Usuarios;

if (!function_exists('usuarioActual')) {
    function usuarioActual()
    {
        return session()->has('usuario_id')
            ? Usuarios::find(session('usuario_id'))
            : null;
    }
}
