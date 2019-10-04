@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($annonces as $annonce)
            <div class="card">
            <div class="card-header">{{ $annonce->title}} by {{$annonce->user['lastname']}}</div>
                <div class="card-body">
                    <div class="card-body">
                        <p class="text-center">Description : {{$annonce->description}}<p>
                        @foreach($annonce->images as $annonce_image)
                            <img src="{{url('/storage') . '/' . $annonce_image->images}}" width="800" height="800" class="img-fluid"><br>
                            <br>
                        @endforeach
                    <p class="text-center">Prix : {{$annonce->price}} euros<p>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-5">
                                @if($annonce->user->id == $connected_user_id)
                                <form method="get" action="{{ route('display_annonce_edit', ['id' => $annonce->id]) }}">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Editer') }}
                                    </button>
                                </form>
                                <form method="post" action="{{ route('delete_single_annonce', ['id' => $annonce->id])}}">  
                                @csrf
                                    <button class="btn btn-outline-danger">{{ __('Effacer article') }}</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            @endforeach
        </div>
    </div>
</div>
@endsection