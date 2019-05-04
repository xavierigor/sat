<div class="form-group row">
    <label for="email">{{ __('Endereço de Email') }}</label>

    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>

<div class="form-group row">
    <label for="password">{{ __('Senha') }}</label>

    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

    @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>

<div class="form-group row">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label class="form-check-label" for="remember">
            {{ __('Lembre-se de mim') }}
        </label>
    </div>
</div>

<div class="form-group row mb-0">
    <button type="submit" class="w-100">
        {{ __('Entrar') }} <i class="fas fa-sign-in-alt ml-1"></i>
    </button>

    @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Esqueceu sua senha?') }}
        </a>
    @endif
</div>