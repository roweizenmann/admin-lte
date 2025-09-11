<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();
        $users->when($request->keyword, function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
                $q->orWhere('email', 'like', '%' . $keyword . '%');
            });
        });

        $users = $users->paginate();

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
        $user->load(['profile', 'interests']);
        $roles = Role::all();
        return view('users.edit', [
            'user' => $user,
            'roles' => $roles
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

    public function updateProfile(User $user, Request $request)
    {
        $input = $request->validate([
            'type' => 'required',
            'address' => 'nullable'
        ]);

        $user->profile()->updateOrCreate([
            'user_id' => $user->id,], $input);

        return back()
            ->with('status', 'Usuário editado com sucesso');

    }

    public function updateInterests(User $user, Request $request)
    {
        $input = $request->validate([
            'interests' => 'nullable|array'
        ]);

        $user->interests()->delete();

        if (!empty($input['interests'])) {
            $user->interests()->createMany($input['interests']);
        }

        return back()
            ->with('status', 'Usuário editado com sucesso');
    }

    public function updateRoles(User $user, Request $request)
    {

        $input = $request->validate([
            'roles' => 'required|array'
        ]);

        $user->roles()->sync($input['roles']);

        return back()
            ->with('status', 'Usuário editado com sucesso');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()
            ->with('status', 'Usuário removido com sucesso');
    }
}
