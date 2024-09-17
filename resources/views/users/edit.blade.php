<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel User Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .main-container{
        background-color:#F2F4FF;
    }
</style>

<body class='main-container'>
    <div class="container">
        <header>
            <h1>Управление пользователями</h1>
        </header>

        <!-- Форма для поиска пользователей -->
        <h2>Поиск пользователей</h2>
        <form action="{{ route('users.search') }}" method="GET">
            <div class="form-group">
            <input type="text" name="query" placeholder="Поиск пользователя" class="form-control">
            <button type="submit" class="btn btn-success" >Найти</button>
            </div>
        </form>

        {{-- Форма для редактирования существующего пользователя --}}
        <h2>Добавить нового пользователя</h2>
        <form action="{{ route('users.update',$user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Имя пользователя</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="birth_date">Дата рождения</label>
                <input type="text" name="birth_date" id="birth_date" class="form-control" value="{{ $user->birth_date }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            {{-- <div class="form-group">
                <label for="login">Логин</label>
                <input type="text" name="login" id="login" class="form-control" required>
            </div> --}}
            {{-- <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div> --}}
            <div class="form-group">
                <label for="phone">Номер</label>
                <input type="tel" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" required>
            </div>
            <div class="form-group">
                <label for="photo">Фото пользователя (опционально)</label>
                <input type="file" name="photo" id="photo" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Добавить пользователя</button>
        </form>

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
            <tbody>
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->login }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->birth_date }}</td>

                    <td>
                        @if($user->photo)
                        <img src="{{ Storage::url($user->photo) }}" alt="Фото" width="50" height="50">
                        @else
                        <span>Нет фото</span>
                        @endif
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Изменить</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        </table>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
