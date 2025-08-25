<?php

namespace App\Http\Controllers;
use App\Models\Heredero;

use Illuminate\Http\Request;

class HerederosControlador extends Controller
{
    // public function index(){
    //     return view('herederos.index'); 
    // }

    public function create(){
        return view('herederos.create'); 
    }

    public function show(){

        $herederos = Heredero::paginate(15);

        return view('herederos.show', compact('herederos')); 
    }
}
