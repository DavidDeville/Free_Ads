@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if($connected_user_id == $user_info->id)
                <div class="card-header">{{ __('Editer le profil') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('edit', ['id' => $user_info->id]) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                            
                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user_info->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>
                            
                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user_info->lastname }}" required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Mail') }}</label>
                            
                            <div class="col-md-6">
                                <input id="email" type="mail" class="form-control @error('mail') is-invalid @enderror" name="email" value="{{ $user_info->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                            <textarea id="password" type="password" class="form-control @error('password') is-invalid @enderror password" name="password">{{ $user_info->password }}</textarea>
                            </div>
                        </div><br>
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary"><a href="{{ route('edit', ['id' => Auth::user()]) }}"></a>
                                    {{ __('Envoyer') }}
                                </button>
                            </div>
                        </div>
                    </form><br>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary"><a href="{{ route('profil', ['id' => Auth::user()]) }}">Retour</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div>Vue interdite</div>
            @endif
        </div>
    </div>
</div>
@endsection
