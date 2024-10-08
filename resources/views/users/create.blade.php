<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create New User</title>
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

        input[type="text"], input[type="password"] {
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

    <h2>Create New User</h2>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <label for="name">Name: </label>
        <input type="text" name="name" id="name" placeholder="Enter user name">
        @error('name')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <label for="email">Email: </label>
        <input type="text" name="email" id="email" placeholder="Enter user email">
        @error('email')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <label for="password">Password: </label>
        <input type="password" name="password" id="password" placeholder="Enter password">
        @error('password')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <label for="roleId">Assign to Role: </label>
        <select name="roleId" id="roleId">
            @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->id }} - {{ $role->name }}</option>
            @endforeach
        </select>

        <input type="submit" value="Create User">
    </form>

</body>
</html>
