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

    public function destroy(Task $task) 
{
    // ✅ Verificar que la tarea pertenezca al usuario actual
    if ($task->user_id !== Auth::id()) {
        abort(403, 'No tienes permiso para eliminar esta tarea');
    }
    
    $task->delete(); 
    return back()->with('success', '¡Tarea eliminada con éxito!');
}

public function update(Request $request, Task $task)
{
    // ✅ Verificar que la tarea pertenezca al usuario actual
    if ($task->user_id !== Auth::id()) {
        abort(403, 'No tienes permiso para actualizar esta tarea');
    }
    
    $task->update($request->all());
    return back()->with('success', '¡Tarea actualizada con éxito!');
}       
       
public function update(Request $request, Task $task)
{
    // Verificar propiedad
    if ($task->user_id !== Auth::id()) {
        abort(403, 'No tienes permiso para editar esta tarea');
    }
    
    // Validar
    $request->validate([
        'title' => 'required|max:255',
    ]);
    
    // Actualizar
    $task->update([
        'title' => $request->title,
        'description' => $request->description,
    ]);
    
    return back()->with('success', '¡Tarea actualizada con éxito!');
}


}