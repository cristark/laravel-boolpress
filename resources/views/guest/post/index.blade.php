@extends('layouts.app')

@section('title', 'Nuovi Articoli')

@section('content')
<div class="container">
        <h1>Elenco Posts</h1>

        @foreach ($posts as $post)    
            <div class="card">
                <h5 class="card-header">{{$post->user->name}}</h5>
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->content}}</p>
                    <a href="{{route('guest.posts.show', $post->slug)}}" class="btn btn-primary">Continua</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection