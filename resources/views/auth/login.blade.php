@extends('layouts.app')

@section('content')
    <div class="container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 170px;">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Se connecter') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="matricule_fiscale"
                                    class="col-md-4 col-form-label text-md-right logintext">{{ __('Matricule Fiscale') }}</label>

                                <div class="col-md-6 username">
                                    <input id="matricule_fiscale" type="text"
                                        class="form-control @error('matricule_fiscale') is-invalid @enderror"
                                        name="matricule_fiscale" value="{{ old('matricule_fiscale') }}" required
                                        autocomplete="matricule_fiscale" autofocus>


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right logintext">{{ __('Mot de passe') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">


                                </div>
                            </div>
                            @error('matricule_fiscale')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
