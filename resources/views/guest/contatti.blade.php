{{-- Estensione layout principale --}}
@extends('layouts.app')

{{-- Title Homepage --}}
@section('title', 'Contatti | Boolpress')

@section('content')
    <div class="container">
        <h1>BoolPress | Contatti</h1>

        {{-- Notifica invio mail --}}
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form action="{{route('guest.contatti.sent')}}" method="post">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="InputName">Nome</label>
                <input type="text" class="form-control" id="InputName" placeholder="Inserisci il tuo nome" name="name">
            </div>

            <div class="form-group">
                <label for="InputMail">Mail</label>
                <input type="email" class="form-control" id="InputMail" placeholder="Inserisci la tua mail" name="email">
                <small id="emailHelp" class="form-text text-muted">Trattamento dati conforme alla GDPR</small>
            </div>

            <div class="form-group">
                <label for="TestoMail">Messaggio</label>
                <textarea class="form-control" id="TestoMail" rows="5" name="message"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Invia</button>
        </form>
    </div>
@endsection
