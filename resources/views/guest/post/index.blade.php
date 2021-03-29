@extends('layouts.app')

@section('title', 'Nuovi Articoli')

@section('content')
<div class="container">
        <h1>Elenco Posts</h1>

        @foreach ($posts as $post)    
            <div class="card mb-5">
                <h5 class="card-header">{{$post->title}}</h5>
                <div class="card-body">
                    <p class="card-text">{{$post->content}}</p>
                    @if ($post->cover)    
                    <img class="d-block mb-4" style="height: 100px;" src="{{asset('storage/'.$post->cover)}}" alt="{{($post->cover) ? $post->title : ''}}">
                    @endif
                    <h5 class="card-title">{{$post->user->name}}</h5>
                    <p>{{substr($post->updated_at,0,10)}}</p>
                    <a href="{{route('guest.posts.show', $post->slug)}}" class="btn btn-primary">Continua</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection