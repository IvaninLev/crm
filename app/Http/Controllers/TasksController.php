<?php

namespace App\Http\Controllers;


use App\Enums\PaginationEnum;
use App\Http\Requests\TaskCompleteRequest;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TasksController extends Controller
{
    public function apiIndex()
    {
        $tasks = TodoList::query()
            ->where(['user_id' => Auth::id()])
            ->paginate(PaginationEnum::PAGE_SIZE->value);

        return TaskResource:: collection($tasks);
    }

    public function index()
    {
        $tasks = TodoList::query()->where(['user_id' => Auth::id()])->paginate(PaginationEnum::PAGE_SIZE->value);
        return Inertia::render('Tasks/Index', [
            'tasks' => TaskResource::collection($tasks)
        ]);
    }

    public function create()
    {
        return Inertia::render('Tasks/Create', [
            'users' => User::select('id', 'name')->get(),
        ]);
    }


    public function store(TaskCreateRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $task = TodoList::create($validated);

        return response()->json([
            'task' => $task
        ]);
    }

    public function edit(TodoList $task)
    {
        return Inertia::render('Tasks/Create', [
            'task' => TaskResource::make($task),
            'edit' => true,
            'statusList' => TodoList::statusList(),
            'users' => User::select('id', 'name')->get(),
        ]);
    }


    public function update(TaskUpdateRequest $request, TodoList $task)
    {
        $validated = $request->validated();

        $task->update($validated);
        $request->session()->flash('task_updated', [
            'message' => 'Task updated successfully',
            'class' => 'alert-success'
        ]);
        return response()->json([
            "success" => true
        ]);
    }


    public function destroy(TodoList $task)
    {
        $name = $task->title;
        $task->delete();
        session()->flash('task_deleted', [
            'message' => 'Task deleted' . $name . ' successfully',
        ]);

    }

    public function complete(TaskCompleteRequest $request, TodoList $task)
    {
        $task->update([
            'completed' => $request->validated('complete')
        ]);
        return response()->json([
            'success' => true
        ]);
    }

    public function show(TodoList $task)
    {
        return Inertia::render('Tasks/View', [
            'task' => TaskResource::make($task)
        ]);
    }

}
