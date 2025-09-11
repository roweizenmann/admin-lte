@extends('layouts.default')
@section('page-title', 'Usuários')
@section('page-actions')
    <a href="{{ route('users.create') }}" class="btn btn-primary">Adicionar usuário</a>
@endsection
@section('content')
    @session('status')
    <div class="alert alert-success">
        {{ $value }}
    </div>
    @endsession

    <form action="{{ route('users.index') }}" method="get" class="mb-3" style="max-width: 500px">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Pesquise por nome ou e-mail"
                   value="{{ request()?->keyword }}">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </div>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Ação</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td style="display: flex; gap: 5px;">

                    @can('edit', \App\Models\User::class)
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    @endcan

                    @can('destroy', \App\Models\User::class)
                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">
                                Excluir
                            </button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $users->links() }}
@endsection
