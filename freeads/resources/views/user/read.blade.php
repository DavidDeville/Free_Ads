@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if($user_info->id == $connected_user_id)
                <div class="card-header">{{ __('Détails du compte') }}</div>
                <div class="card-body">
                    <div class="card-body">
                        <p class="text-center">Nom : {{ $user_info->name }}<p>
                        <p class="text-center">Prénom : {{ $user_info->lastname }}<p>
                        <p class="text-center">Adresse mail : {{ $user_info->email }}<p>                       
                        <p class="text-center">Password: Secret défense<p>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-5">
                                <form method="get" action="{{ route('profil_edit', ['id' => Auth::user()]) }}">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Editer') }}
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Supprimer') }}
                                    </button>
                                </form>
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
</div>
@endsection
