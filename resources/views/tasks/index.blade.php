<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white shadow-lg rounded-2xl p-6 w-full max-w-xl">

    <!-- ✅ DASHBOARD HEADER -->
    <div class="mb-4">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <p class="text-gray-500 text-sm">Manage your tasks efficiently</p>
    </div>

    <!-- ✅ STATS CARDS -->
    <div class="grid grid-cols-3 gap-3 mb-4 text-center">

        <div class="bg-blue-100 p-3 rounded">
            <p class="text-lg font-bold">{{ $tasks->count() }}</p>
            <p class="text-xs">Total</p>
        </div>

        <div class="bg-green-100 p-3 rounded">
            <p class="text-lg font-bold">
                {{ $tasks->where('is_completed', true)->count() }}
            </p>
            <p class="text-xs">Completed</p>
        </div>

        <div class="bg-red-100 p-3 rounded">
            <p class="text-lg font-bold">
                {{ $tasks->where('is_completed', false)->count() }}
            </p>
            <p class="text-xs">Pending</p>
        </div>

    </div>

    <!-- Filters -->
    <div class="flex justify-center gap-3 mb-4">
        <a href="/?filter=all" class="px-3 py-1 bg-gray-200 rounded">All</a>
        <a href="/?filter=pending" class="px-3 py-1 bg-yellow-200 rounded">Pending</a>
        <a href="/?filter=completed" class="px-3 py-1 bg-green-200 rounded">Completed</a>
        <a href="/?filter=overdue" class="px-3 py-1 bg-red-200 rounded">Overdue</a>
    </div>

    <!-- Add Task -->
    <form method="POST" action="/add" class="flex gap-2 mb-4">
        @csrf
        <input type="text" name="title" placeholder="Enter task"
            class="flex-1 border rounded px-3 py-2">

        <input type="date" name="due_date"
            class="border rounded px-2">

        <button class="bg-blue-500 text-white px-4 py-2 rounded transition duration-300 hover:bg-blue-600 hover:scale-105">
            Add
        </button>
    </form>

    <!-- Task List -->
    <ul class="space-y-2">
        @foreach($tasks as $task)
            <li class="flex justify-between items-center p-3 rounded shadow-sm transition duration-300 hover:scale-[1.02] hover:shadow-md" style="background-color: #69feff;">

                <div>
                    @if($task->is_completed)
                        <p class="line-through text-gray-400">{{ $task->title }}</p>
                    @else
                        <p>{{ $task->title }}</p>
                    @endif

                    @if($task->due_date)
                        <small class="text-gray-500">Due: {{ $task->due_date }}</small>
                    @endif

                    @if($task->due_date && $task->due_date < date('Y-m-d') && !$task->is_completed)
                        <span class="text-red-500 text-xs ml-2">Overdue</span>
                    @endif
                </div>

                <div class="flex gap-2">
                    <a href="/toggle/{{ $task->id }}" class="text-green-600">✔</a>
                    <a href="/edit/{{ $task->id }}" class="text-blue-600">Edit</a>
                    <a href="/delete/{{ $task->id }}" class="text-red-600">Delete</a>
                </div>

            </li>
        @endforeach
    </ul>

</div>

</body>
</html>