<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-6 rounded shadow w-full max-w-md">

    <h2 class="text-xl font-bold mb-4">Edit Task</h2>

    <form method="POST" action="/update/{{ $task->id }}" class="space-y-3">
        @csrf

        <input type="text" name="title"
            value="{{ $task->title }}"
            class="w-full border px-3 py-2 rounded">

        <input type="date" name="due_date"
            value="{{ $task->due_date }}"
            class="w-full border px-3 py-2 rounded">

        <button class="bg-blue-500 text-white px-4 py-2 rounded w-full">
            Update
        </button>
    </form>

</div>

</body>
</html>