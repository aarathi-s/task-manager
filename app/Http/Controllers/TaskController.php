<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // Show all tasks
    public function index(Request $request)
{
    $query = Task::query();

    // Filter logic
    if ($request->filter == 'completed') {
        $query->where('is_completed', true);
    } elseif ($request->filter == 'pending') {
        $query->where('is_completed', false);
    } elseif ($request->filter == 'overdue') {
        $query->where('due_date', '<', date('Y-m-d'))
              ->where('is_completed', false);
    }

    $tasks = $query->get();

    return view('tasks.index', compact('tasks'));
}

    // Add new task
    public function store(Request $request)
{
    Task::create([
        'title' => $request->title,
        'due_date' => $request->due_date
    ]);

    return redirect('/');
}

    // Delete task
    public function destroy($id)
    {
        Task::destroy($id);
        return redirect('/');
    }

    public function toggle($id)
{
    $task = Task::find($id);
    $task->is_completed = !$task->is_completed;
    $task->save();

    return redirect('/');
}

// Show edit form
public function edit($id)
{
    $task = Task::find($id);
    return view('tasks.edit', compact('task'));
}

// Update task
public function update(Request $request, $id)
{
    $task = Task::find($id);
    $task->title = $request->title;
    $task->due_date = $request->due_date;
    $task->save();

    return redirect('/');
}
}