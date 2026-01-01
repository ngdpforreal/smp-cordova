<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        // Ambil semua program
        $programs = Program::all();
        
        return view('programs.index', compact('programs'));
    }
}