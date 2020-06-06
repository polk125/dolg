@extends('layouts.navbar')
@section('content')
<link rel="stylesheet" href="{{ asset('css/starttest.css')}}">
<link rel="stylesheet" href="{{ asset('css/journ.css')}}">
<link rel="stylesheet" href="{{ asset('css/img.css')}}">
<a class="typejourn" href={{ asset('tests/')}}>Назад</a>
<div class="test-render">
    <div class="example">
        <h1>Название теста: {{$test->name}}</h1>
        <p><span>Автор:</span> @if(isset($who->name)) <a href="{{ asset('users/'.$who->id)}}">{{$who->name}}</a> @else Неизвестный автор @endif</p>
        <p><span>Тема:</span> {{$test->theme}}</p>
        <p><span>Предмет:</span> {{$lesson->name}}</p>
        <div class="demo" id="demo"></div>
        @if($test->include!=NULL)
            @if(substr($test->include, -3)=='png'|| substr($test->include, -3)=='jpg' || substr($test->include, -3)=='gif')
            
                <img src="{{ asset('docs/'.$test->include) }}" class="minimized" alt="клик для увеличения" />
                @else
                <br>
                <a class="typejourn" href={{ asset('docs/'.$test->include)}}>Перейти</a>
                <a class="typejourn" href={{ asset('download/'.$test->include)}}>Скачать</a>
            @endif      
        @endif       
    </div>
    <?php $num = 0?>
@foreach($question as $objs)
    <?php $num++?>
    <div class="wrapped_question">
        <div class="question">
        <div class="quest">
        <h3>Вопрос №{{$num}}</h3>
        <p> {!! nl2br(e($objs->question)) !!} </p>
        @if($objs->include!=NULL)
        @if(substr($objs->include, -3)=='png'|| substr($objs->include, -3)=='jpg' || substr($objs->include, -3)=='gif')
        
            <img class="minimized addimg" src="{{ asset('docs/'.$objs->include) }}">
            @else
            <br>
            <a class="typejourn" href={{ asset('docs/'.$objs->include)}}>Перейти</a>
            <a class="typejourn" href={{ asset('download/'.$objs->include)}}>Скачать</a>
        @endif      
    @endif
        </div>
        <?php $numb = 0?>
        <div class="help">Ответы:</div>
        @foreach($answers[$objs->id] as $answer)
            <?php $numb++ ?>
                
            <div class="answer @if($answer->correct == 1) correct @endif">
                <label class="container">{{$numb}}. {{$answer->text}}
                </label>
                @if($answer->include!=NULL)
                @if(substr($answer->include, -3)=='png'|| substr($answer->include, -3)=='jpg' || substr($answer->include, -3)=='gif')
                            
                    <img class="minimized addimg" src="{{ asset('docs/'.$answer->include) }}">
                 @else
                    <br>
                    <a class="typejourn" href={{ asset('docs/'.$answer->include)}}>Перейти</a>
                    <a class="typejourn" href={{ asset('download/'.$answer->include)}}>Скачать</a>
                @endif  
                @endif
            </div>
        @endforeach

    </div>
    </div>
@endforeach
</div>
<script src="{{ asset('js/jquery.js')}}"></script>
<script src="{{ asset('js/img.js')}}"></script>
@endsection
