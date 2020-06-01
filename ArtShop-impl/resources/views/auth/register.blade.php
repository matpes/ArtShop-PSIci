{{-- register forma za pravljenje slikar/kupac naloga --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <form method="POST" action="{{ route('register') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @csrf
                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Korisničko ime:') }}</label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control @error('name') is-invalid @enderror form_input_text"
                                   name="username" value="{{ old('name') }}" required autocomplete="username" autofocus
                                   placeholder="unesite korisničko ime">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail: ') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control form_input_text @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                   placeholder="unesite e-mail">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Lozinka: ') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control form_input_text @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password"
                                   placeholder="unesite lozinku">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                               class="col-md-4 col-form-label text-md-right">{{ __('Ponovljena lozinka: ') }}</label>

                        <div class="col-md-6">
                            <input id="password_confirm" type="password" class="form-control form_input_text @error('password_confirm') is-invalid @enderror"
                                   name="password_confirm" required autocomplete="new-password"
                                    placeholder="unesite lozinku ponovo">

                            @error('password_confirm')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <label for="optradio" class="col-md-4 col-form-label text-md-right">
                            {{ __('Registruj se kao:') }}</label>
                        <div class="col-md-2 float-md-left">
                                <label><input type="radio" name="optradio" value="slikar"
                                        class="text-md-left float-md-left" checked>Slikar</label>
                                <label><input type="radio" name="optradio" value="kupac"
                                        class="text-md-left float-md-left">Kupac</label>
                                <label><input type="radio" name="optradio" value="admin"
                                          class="text-md-left float-md-left">Administrator</label>
                        </div>
                        <div class="col-md-6 offset-md-6 float-md-right">
                            <button type="submit" class="btn btn-warning">
                                {{ __('Registruj se') }}
                            </button>
                        </div>
                    </div>

                </form>
            <br> <br>
        </div>
    </div>
</div>
<footer>
    <a class="btn btn-link-btn" href="{{ route('home') }}">
        <button type="button" class="btn btn-warning">
            {{ __('Povratak na početnu') }}
        </button>
    </a>
</footer>
@endsection
