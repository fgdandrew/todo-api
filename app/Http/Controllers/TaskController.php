<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * Получить список всех задач
     */
    public function index(): JsonResponse
    {
        $tasks = Task::all();
        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }

    /**
     * Создать новую задачу
     */
    public function store(TaskRequest $request): JsonResponse
    {
        $task = Task::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Задача успешно создана',
            'data' => $task
        ], 201);
    }

    /**
     * Получить конкретную задачу
     */
    public function show(int $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Задача не найдена'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $task
        ]);
    }

    /**
     * Обновить задачу
     */
    public function update(TaskRequest $request, int $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Задача не найдена'
            ], 404);
        }

        $task->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Задача успешно обновлена',
            'data' => $task
        ]);
    }

    /**
     * Удалить задачу
     */
    public function destroy(int  $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Задача не найдена'
            ], 404);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Задача успешно удалена'
        ]);
    }
}
