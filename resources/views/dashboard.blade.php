<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Đảm bảo nút hiển thị giống button thật */
        a button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <a href="/users">
        <button>Users</button>
    </a>
    <a href="/projects">
        <button>Projects</button>
    </a>
    <a href="/tasks">
        <button>tasks</button>
    </a>
</body>
</html>
