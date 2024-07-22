@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')
    <div class=" container mx-auto flex">
        <div class=" md:w-1/2">
            <img src="{{asset('uploads').'/'.$post->imagen}}" alt="{{$post->titulo}}">
            
            <div>
                <p>0 Likes</p>
            </div>
        
        </div>

    </div>
@endsection