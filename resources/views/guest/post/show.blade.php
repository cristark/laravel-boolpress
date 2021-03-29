@extends('layouts.app')

@section('title', 'Dettaglio Articolo')

@section('content')
    <div class="container"> 
        <div class="card">
            <h5 class="card-header">{{$post->user->name}}</h5>
            <div class="card-body">
                <h5 class="card-title mb-4">{{$post->title}}</h5>
                @if ($post->cover)
                <img class="mb-4" style="width: 50%;" src="{{asset('storage/'.$post->cover)}}" alt="{{($post->cover) ? $post->title : ''}}">
                @endif
                <p class="card-text">{{$post->content}}</p>
                <a href="{{route('guest.posts.index')}}" class="btn btn-primary">Mostra tutti gli Articoli</a>
            </div>
        </div>
    </div>
@endsection