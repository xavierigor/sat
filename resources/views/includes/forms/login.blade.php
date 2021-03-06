<div class="form-group row">
    <label for="email">{{ __('Endereço de Email') }}</label>

    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
        <span class="invalid-feedback text-left" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>

<div class="form-group row">
    <label for="password">{{ __('Senha') }}</label>

    <div class="input-group">
        <input id="password" type="password" class="input-senha form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        <div class="input-group-append">
            <button class="button-senha btn btn-outline-secondary-2 btn-sm" type="button" onclick="mostrarSenha()">
                <i class="fas fa-eye fa-fw"></i>
            </button>
        </div>
    </div>
    @if ($errors->has('password'))
        <span class="invalid-feedback text-left" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>

{{-- <div class="form-group row">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label class="form-check-label" for="remember">
            {{ __('Lembre-se de mim') }}
        </label>
    </div>
</div> --}}

<div class="form-group mb-4 row mt-4">
    <button type="submit" class="w-100 btn btn-outline-laranja">
        {{ __('Entrar') }} <i class="fas fa-sign-in-alt ml-1"></i>
    </button>

    @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Esqueceu sua senha?') }}
        </a>
    @endif
</div>