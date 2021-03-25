@extends('layouts.app')

@section('title', 'Dettaglio Articolo')

@section('content')
    <div class="container"> 
        <div class="card">
            <h5 class="card-header">{{$post->user->name}}</h5>
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">{{$post->content}}</p>
                <a href="{{route('guest.posts.index')}}" class="btn btn-primary">Mostra tutti gli Articoli</a>
            </div>
        </div>
    </div>
@endsection