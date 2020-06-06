@extends('layouts/navbar')
@section('content')
<?php 
function findValue($date, $answer, $pass) {
        
        foreach($date as $d) {
            if( $d->complitedpass_id != $pass ) continue;
            if( $d->answer_id != $answer ) continue;
            return 1;
        }
        return ' ';
    }
?>
<div class="timer" data-hours="{{$test->hours}}" data-minutes="{{$test->minutes}}" @if($pass->started !== NULL)data-started="{{$pass->started}}"@endif></div>
<link rel="stylesheet" href="{{ asset('css/starttest.css')}}">
<link rel="stylesheet" href="{{ asset('css/journ.css')}}">
<link rel="stylesheet" href="{{ asset('css/img.css')}}">
<a class="typejourn" href={{ asset('start/'.$pass->id)}}>Назад</a>
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
        <p> {!! nl2br(e($objs->question)) !!}</p>
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
        <div class="help">Выберите правильный ответ:</div>
        @foreach($answers[$objs->id] as $answer)
            <?php $numb++ ?>
                
            <div class="answer ">
                <label class="container">{{$numb}}. {{$answer->text}}
                    <input class="answer_type" @if(isset($complited))@if(findValue( $complited,$answer->id,$pass->id)==1) checked @endif @endif type="checkbox" data-type="{{$answer->id}}" data-test="{{$pass->id}}">
                    <span class="checkmark"></span>
                </label>
            
                @if(substr($answer->include, -3)=='png'|| substr($answer->include, -3)=='jpg' || substr($answer->include, -3)=='gif')
                            
                                <img class="minimized addimg" src="{{ asset('docs/'.$answer->include) }}">
                @endif
            </div>
        @endforeach

    </div>
    </div>
@endforeach
<div class="complite"><button value="{{$pass->id}}" class="admin-btn end-test">Завершить тест</button></div>
</div>
<script src="{{ asset('js/jquery.js')}}"></script>
<script src="{{ asset('js/img.js')}}"></script>
<script src="{{ asset('js/complitetest.js')}}"></script>
@endsection