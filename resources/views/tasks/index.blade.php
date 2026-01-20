<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Tareas - Higan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3>Gestor de Tareas</h3>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('tasks.store') }}" method="POST">
    @csrf  <input type="text" name="title" ...>
    <button type="submit">Añadir</button>
</form>

                        <hr>

                        <ul class="list-group">
                            @forelse($tasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $task->title }}
                                    <span class="badge bg-secondary">{{ $task->status }}</span>
                                </li>
                            @empty
                                <li class="list-group-item text-center">No hay tareas pendientes. ¡Buen trabajo!</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>