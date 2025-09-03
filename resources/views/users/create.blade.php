@extends('layouts.default')
@section('page-title', 'Adicionar Usuário')

@section('content')
    <form action="{{ route('users.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   name="name" aria-describedby="emailHelp" value="{{ old('name') }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" aria-describedby="emailHelp" value="{{ old('email') }}">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password">
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
@endsection
