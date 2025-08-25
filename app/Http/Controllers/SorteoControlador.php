<?php

namespace App\Http\Controllers;
use App\Models\Sorteo;

use Illuminate\Http\Request;

class SorteoControlador extends Controller
{
    // public function index(){
    //     return view('sorteo.index'); 
    // }

    public function create(){
        return view('sorteo.create'); 
    }

    public function show(){

        $sorteos = Sorteo::paginate(15);

        return view('sorteo.show', compact('sorteos')); 
    }
}
