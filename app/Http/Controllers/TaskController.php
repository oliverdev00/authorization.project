<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        // Solo traemos las tareas del usuario logueado
        $tasks = Auth::user()->tasks; 
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
            'title' => 'required|max:255',
        ]);

        // Crear la tarea asociada al usuario
        Auth::user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return back()->with('success', '¡Tarea creada con éxito!');
    }
}