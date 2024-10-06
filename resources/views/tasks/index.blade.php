<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .alert {
            width: 50%;
            margin: 0 auto 20px;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #28a745;
            color: #fff;
        }

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            margin-right: 10px;
        }

        input[type="text"], select {
            padding: 5px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 6px 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f8f9fa;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"] {
            margin-right: 5px;
        }

        button[type="submit"]:nth-child(1) {
            background-color: #28a745;
            color: white;
        }

        button[type="submit"]:nth-child(2) {
            background-color: #dc3545;
            color: white;
        }

        input[type="button"] {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

    </style>
</head>

<body>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-success">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{route('tasks.filter')}}" method="POST">
        @csrf
        <div>
            <label for="filterTitle">Title</label>
            <input type="text" name="filterTitle" id="filterTitle">
            <label for="filterStatus">Status</label>
            <select name="filterStatus" id="filterStatus">
                <option value="1">Completed</option>
                <option value="0">Doing</option>
            </select>
            <input type="submit" value="Filter">
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>User</th>
                <th>Project</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->completed == 1 ? 'Completed' : 'Doing' }}</td>
                    <td>{{ $task->user ? $task->user->name : 'No User Assigned' }}</td>
                    <td>{{ $task->project ? $task->project->name : 'No Project Assigned' }}</td>
                    <td>
                        <form action="{{ route('tasks.edit', ['id' => $task->id]) }}" method="GET">
                            <button type="submit">Update</button>
                        </form>
                        
                        <form action="{{ route('tasks.destroy', ['id' => $task->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xoá task này?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <input type="button" value="Create Task" onclick="redirect()">

</body>

<script>
    function redirect() {
        var url = "/tasks/create";
        window.location.href = url;
    }
</script>

</html>
