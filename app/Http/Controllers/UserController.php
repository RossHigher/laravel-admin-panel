<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Показать список всех пользователей
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Поиск пользователей
    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('login', 'LIKE', "%{$query}%")
            ->get();
    
        // Возвращаем представление 'users.index'
        return view('users.index', compact('users'));
    }
    


    // Создание нового пользователя
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'login' => 'required|unique:users',
            'password' => 'required',
            'birth_date' => 'required',
            'phone' => 'required',
            'photo' => 'nullable|image|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
        }
        // Процесс создания нового пользователя
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'login' => $request->input('login'),
            'phone' => $request->input('phone'),
            'birth_date' => $request->input('birth_date'),
            'password' => bcrypt($request->input('password')),
            'photo' => $path,
        ]);

        return redirect()->route('users.index')->with('success', 'Пользователь создан!');
    }

    // Удаление пользователя
    public function destroy(User $user)
    {
        if ($user->photo) {
            Storage::delete('public/' . $user->photo);
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Пользователь удален!');
    }

    // Показать форму для редактирования
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Обновление данных пользователя
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'birth_date' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|max:2048',
        ]);

        $path = $user->photo;

        if ($request->hasFile('photo')) {
            // Удаляем старое фото, если есть
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }
            $path = $request->file('photo')->store('photos', 'public');
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request-> input('phone'),
            'birth_date' => $request-> input('birth_date'),
            'photo' => $path,
        ]);

        //Испльзуем редикрет для перемещения на заглавную страницу
        return redirect()->route('users.index')->with('success', 'Пользователь обновлен!');
    }
}
