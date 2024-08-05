@extends('layouts.app')
<!-- Definición la parte de Section -->
@section('titulo')
    Pagina Principal
@endsection

@section('contenido')
    <x-listar-post :posts="$posts">
        <h1>Mostrando Post desde Slot</h1>
    </x-listar-post>
@endsection('contenido')    