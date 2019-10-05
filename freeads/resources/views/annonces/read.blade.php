@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($annonces as $annonce)
            <div class="card">
            <div class="card-header"><a href="{{ route('display_single_annonce', ['id' => $annonce->id])}}">{{ $annonce->title}}</a> by <a href="{{ route('profil', ['id' => $annonce->user->id]) }}">{{$annonce->user['lastname']}}</a></div>
                <div class="card-body">
                    <div class="card-body">
                            <img src="{{url('/storage') . '/' . $annonce->images[0]->images}}" width="800" height="800" class="img-fluid"><br>
                            <br>
                    <p class="text-center">Prix : {{$annonce->price}} euros<p>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-5">
                                @if($connected_user_id == $annonce->user['id'])
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
            {{$annonces->links()}}
        </div>
    </div>
</div>
@endsection