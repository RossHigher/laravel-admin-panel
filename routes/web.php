<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::get('/', function () {
    $users = User::all();
    return view('users.index', compact('users'));
});


Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Список пользователей
Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Создание пользователя
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Удаление пользователя
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // Редактирование пользователя
Route::get('/users/search', [UserController::class, 'search'])->name('users.search'); //Для Поиска и полного вывода, если пусто
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update'); // Обновление пользователя
