<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>

    <h2>Edit Task</h2>

    <form action="{{ route('tasks.update', ['id' => $task->id]) }}" method="POST">
        @csrf
        @method('PATCH')

        <label for="title">Title: </label>
        <input type="text" name="title" id="title" value="{{ $task->title }}" placeholder="Enter task title">

        <label for="description">Description: </label>
        <input type="text" name="description" id="description" value="{{ $task->description }}" placeholder="Enter task description">

        <label for="completed">Completed: </label>
        <select name="completed" id="completed">
            <option value="1" {{ $task->completed == 1 ? 'selected' : '' }}>Completed</option>
            <option value="0" {{ $task->completed == 0 ? 'selected' : '' }}>Doing</option>
        </select>

        <label for="userId">Assign to User: </label>
        <select name="userId" id="userId">
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->id }} - {{ $user->name }}
                </option>
            @endforeach
        </select>

        <label for="projectId">Assign to Project: </label>
        <select name="projectId" id="projectId">
            @foreach ($projects as $project)
            <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                {{ $project->id }} - {{ $project->name }}
            </option>
            @endforeach
        </select>

        <input type="submit" value="Update Task">
    </form>

</body>
</html>
