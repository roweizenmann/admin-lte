<div class="card">
    <form action="{{ route('users.updateInterests', $user->id) }}" method="post">
        @csrf
        @method('put')
        <div class="card-header">
            Interesses
        </div>
        <div class="card-body">
            @foreach(['Futebol', 'Formula 1'] as $item)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $item }}" name="interests[][name]">
                    <label class="form-check-label">
                        {{ $item }}
                    </label>
                </div>
            @endforeach
        </div>

        @error('interests')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>

    </form>
</div>





