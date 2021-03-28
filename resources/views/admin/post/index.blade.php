{{-- Estensione layout principale --}}
@extends('layouts.admin')

@section('content')
<div class="container">

    {{-- Pulsante creazione Nuovo Post --}}
    <a href="{{route('post.create')}}"><button type="button" class="btn btn-primary mb-3">Crea un nuovo Post</button></a>

    {{-- Notifica eliminazione post esistente --}}
    @if (session('status'))
	    <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    {{-- Tabella Post DataBase --}}
    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Autore</th>
                <th scope="col">Titolo</th>
                <th scope="col">Contenuto</th>
                <th scope="col">Data Creazione</th>
                <th scope="col">Data Modifica</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{Str::limit($post->content, 50)}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
                    <td><a href="{{route('post.show', ['post' => $post->id])}}"><button type="button" class="btn btn-info">Visualizza</button></a></td>
                    <td><a href="{{route('post.edit', ['post' => $post->id])}}"><button type="button" class="btn btn-warning">Modifica</button></a></td>
                    <td>
                        <form method="post" action="{{route('post.destroy', ['post' => $post->id])}}">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection