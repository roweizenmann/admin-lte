<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        User::create($input);
        return redirect()
            ->route('users.index')
            ->with('status', 'Usuário adicionado com sucesso');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $input = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'exclude_if:password,null|min:8',
        ]);

        $user->fill($input)->save();

        return back()
            ->with('status', 'Usuário atualizado com sucesso');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()
            ->with('status', 'Usuário removido com sucesso');
    }
}
