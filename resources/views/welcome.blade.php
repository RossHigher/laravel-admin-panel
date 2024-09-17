<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel User Management</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <style>
        .container {
            padding: 5vh;
        }
        .form-control, .btn {
            margin-bottom: 10px;
        }
        table {
            margin-top: 20px;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
    </style>

    <header>
        <div class="clusters container">
            <h1>Управление пользователями</h1>
        </div>
    </header>

    <div class="container">
        <h2>Поиск пользователей</h2>
        <form action="{{ route('users.search') }}" method="GET">
            <div class="form-group">
            <input type="text" name="query" placeholder="Поиск пользователя" class="form-control">
            <button type="submit" class="btn btn-success" >Найти</button>
            </div>
        </form>
        
        <!-- Форма для создания нового пользователя -->
        <h2>Добавить нового пользователя</h2>
        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Имя пользователя</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="birth_date">Дата рождения</label>
                <input type="text" name="birth_date" id="birth_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="login">Логин</label>
                <input type="text" name="login" id="login" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Номер</label>
                <input type="tel" name="phone" id="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="photo">Фото пользователя (опционально)</label>
                <input type="file" name="photo" id="photo" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Добавить пользователя</button>
        </form>

        <!-- Вывод существующих пользователей в виде таблицы -->
        <h2 class="mt-5">Список пользователей</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Почта</th>
                    <th>Логин</th>
                    <th>Номер</th>
                    <th>Дата рождения</th>
                    <th>Фото</th>
                    <th>Действия</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
