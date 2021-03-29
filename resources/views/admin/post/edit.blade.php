{{-- Estensione layout principale --}}
@extends('layouts.admin')

@section('content')
    <div class="container">

        {{-- Controllo errori --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form method="post" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="InputTitle">Titolo</label>
                <input type="text" class="form-control" id="InputTitle" placeholder="Inserisci il titolo" name="title" value="{{$post->title}}">
            </div>

            @if ($post->cover)
                <p>Immagine inserita:</p>
                <img class="d-block" style="height: 150px;" src="{{asset('storage/'.$post->cover)}}" alt="{{$post->title}}">
                <label for="InputFile">Sostituisci l'immagine</label>    
            @else
                <p class="alert alert-dark">Immagine non inserita</p>
                <label for="InputFile">Carica un'immagine</label>
            @endif
            
            <div class="form-group">
                <input type="file" class="form-control-file" id="InputFile" name="cover">
            </div>

            <div class="form-group">
                <label for="InputContent">Testo</label>
                <textarea class="form-control" id="InputContent" placeholder="Inserisci il testo qui" cols="30" rows="10" name="content">{{$post->content}}</textarea>
            </div>

            <div class="check_container d-flex flex-wrap mb-4">
                @foreach ($tags as $tag)
                    <div class="form-check mr-4">
                        <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="defaultCheck" name="tags[]" {{$post->tags->contains($tag->id) ? 'checked' : ''}}>
                        <label class="form-check-label" for="defaultCheck">{{$tag->name}}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="Check1" required>
                <label class="form-check-label" for="Check1">Spuntando confermi che il testo inserito è conforme al regolamento del blog</label>
            </div>
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
        <a class="d-flex justify-content-end" href="{{route('post.index')}}"><button type="submit" class="btn btn-warning">Annulla</button></a>
    </div>
@endsection