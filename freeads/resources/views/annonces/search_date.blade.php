@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($annonces as $annonce)
            <div class="card">
            <div class="card-header">
                <a href="{{ route('display_single_annonce', ['id' => $annonce->id])}}">{{ $annonce->title}}</a> by 
                <a href="{{ route('profil', ['id' => $annonce->user->id]) }}">{{$annonce->user['lastname']}}</a> 
                le {{ $annonce->created_at }}
            </div>
                <div class="card-body">
                    <div class="card-body">
                            <img src="{{url('/storage') . '/' . $annonce->images[0]->images}}" width="800" height="800" class="img-fluid"><br>
                            <br>
                    <p class="text-center">Prix : {{$annonce->price}} euros<p>
                    </div>
                </div>
            </div>
            <br><br>
            @endforeach
        </div>
    </div>
</div>
@endsection