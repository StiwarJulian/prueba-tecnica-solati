<?php

namespace App\Http\Controllers;

use App\Http\DTO\TaskDeleteDTO;
use App\Http\DTO\TaskDTO;
use App\Models\Task;
use Illuminate\Http\Request;
use Validator;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function show(Task $task)
    {
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pendiente,completada',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $taskDTO = new TaskDTO($request->input('title'), $request->input('description'), $request->input('status'));

        $task = Task::create([
            'titulo' => $taskDTO->getTitulo(),
            'descripcion' => $taskDTO->getDescripcion(),
            'estado' => $taskDTO->getEstado(),
        ]);

        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:pendiente,completada',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $taskDTO = new TaskDTO(
            $request->input('title', $task->title),
            $request->input('description', $task->description),
            $request->input('status', $task->status)
        );

        $task->update([
            'title' => $taskDTO->getTitulo(),
            'description' => $taskDTO->getDescripcion(),
            'status' => $taskDTO->getEstado(),
        ]);

        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted']);
    }
}
