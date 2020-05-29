@extends('layouts.navbar')
@section('content')
<link rel="stylesheet" href="{{ asset('css/material.css')}}">
<link rel="stylesheet" href="{{ asset('css/journ.css')}}">
<link rel="stylesheet" href="{{ asset('css/img.css')}}">
<a class="typejourn" href={{ asset('materials')}}>Назад</a>
<div class="test-render">
    <div class="example">
        <h1>Учебный материал: {{$test->name}}</h1>
        <p>Автор: <a href="{{ asset('users/'.$who->id)}}">{{$who->name}}</a></p>
        <p>Тема: {{$test->theme}}</p>
        <p>Предмет: {{$lesson->name}}</p>
        @if($test->include!=NULL)
            @if(substr($test->include, -3)=='png'|| substr($test->include, -3)=='jpg' || substr($test->include, -3)=='gif')
            
                <img src="{{ asset('docs/materials/'.$test->include) }}" class="minimized" alt="клик для увеличения" />
                @else
                <br>
                <a class="typejourn" href={{ asset('docs/material/'.$test->include)}}>Перейти</a>
                <a class="typejourn" href={{ asset('download/materials/'.$test->include)}}>Скачать</a>
            @endif      
        @endif
    </div>
    <?php $num = 0?>
@foreach($question as $objs)
    <?php $num++?>

    <div class="question">
    <h3>Дополнительный материал №{{$num}}: 
        
        @if(substr($objs->include, -3)=='png'|| substr($objs->include, -3)=='jpg' || substr($objs->include, -3)=='gif')
                    
            <img  class="minimized addimg" src="{{ asset('docs/materials/'.$objs->include) }}" >
        @else
        <br>
        <h1>{{explode(".", $objs->include)[0]}}</h1>
        <a class="typejourn" href={{ asset('docs/material/'.$objs->include)}}>Перейти</a>
        <a class="typejourn" href={{ asset('download/materials/'.$objs->include)}}>Скачать</a>
        @endif
    </h3>
    </div>

@endforeach
</div>
<script src="{{ asset('js/jquery.js')}}"></script>
<script src="{{ asset('js/img.js')}}"></script>
@endsection
