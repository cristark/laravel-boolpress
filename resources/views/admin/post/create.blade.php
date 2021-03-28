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

        {{-- Form inserimento dati --}}
        <form method="post" action="{{route('post.store')}}">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="InputTitle">Titolo</label>
                <input type="text" class="form-control" id="InputTitle" placeholder="Inserisci il titolo" name="title" value="{{old('title')}}">
            </div>

            <div class="form-group">
                <label for="InputContent">Testo</label>
                <textarea class="form-control" id="InputContent" placeholder="Inserisci il testo qui" cols="30" rows="10" name="content">{{old('content')}}</textarea>
            </div>
            
            <div class="check_container d-flex flex-wrap mb-4">
                @foreach ($tags as $tag)
                    <div class="form-check mr-4">
                        <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="defaultCheck" name="tags[]">
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
    </div>
@endsection