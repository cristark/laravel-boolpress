{{-- Estensione layout principale --}}
@extends('layouts.admin')

@section('content')
    <div class="container">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Autore</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Contenuto</th>
                    <th scope="col">Data Creazione</th>
                    <th scope="col">Data Modifica</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->content}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
                </tr>
            </tbody>
        </table>
        <div class="actions d-flex justify-content-between">

            <div class="action-1">
                <a href="{{route('post.index')}}"><button type="button" class="btn btn-primary">Torna Indietro</button></a>
            </div>
            
            <div class="action-2 d-flex">
                <a class="mr-2" href="{{route('post.edit', ['post' => $post->id])}}"><button type="button" class="btn btn-warning">Modifica</button></a>
                <form method="post" action="{{route('post.destroy', ['post' => $post->id])}}">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                </form>
            </div>
        </div>
    </div>
@endsection