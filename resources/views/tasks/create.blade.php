<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Task</title>
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
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>

    <h2>Create New Task</h2>

    <form action="{{ route('tasks.store') }}" method="post">
        @csrf
        <label for="title">Title: </label>
        <input type="text" name="title" id="title" placeholder="Enter task title">

        <label for="description">Description: </label>
        <input type="text" name="description" id="description" placeholder="Enter task description">

        <label for="completed">Completed: </label>
        <select name="completed" id="completed">
            <option value="1">Completed</option>
            <option value="0">Doing</option>
        </select>

        <label for="userId">Assign to User: </label>
        <select name="userId" id="userId">
            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->id }} - {{ $user->name }}</option>
            @endforeach
        </select>
        
        <label for="projectId">Assign to Project: </label>
        <select name="projectId" id="projectId">
            @foreach ($projects as $project)
            <option value="{{ $project->id }}">{{ $project->id }} - {{ $project->name }}</option>
            @endforeach
        </select>
        
        <input type="submit" value="Create Task">
    </form>

</body>
</html>
