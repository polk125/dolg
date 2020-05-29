@extends('layouts/navbar')
@section('content')
<link rel="stylesheet" href="{{ asset('css/complitetest.css')}}">
<link rel="stylesheet" href="{{ asset('css/journ.css')}}">
<link rel="stylesheet" href="{{ asset('css/img.css')}}">
<a class="typejourn" href={{ asset('alerts')}}>Назад</a>
@if($pass->tire == 0)
    @if(Auth::user()->typeAdmin == 3)
    <div class="test-render">
        <div class="example">
            <h1>Название теста: {{$test->name}}</h1>
            <p><span>Автор:</span> <a href="{{ asset('users/'.$who->id)}}">{{$who->name}}</a></p>
            <p><span>Тема:</span> {{$test->theme}}</p>
            <p><span>Предмет:</span> {{$lesson->name}}</p>   
            <p><span>Количество вопросов:</span> {{$question}}</p>
            <p><span>Время на решение теста:</span> Часов: {{$test->hours}} Минут: {{$test->minutes}}</p>
            <a class="start" href="{{ asset('complite/'.$pass->id)}}"> Начать тест </a>
        </div>
    </div>
    @elseif(AUth::user()->typeAdmin == 2)
        <div class="test-render">
            <div class="example">
                <h1>Название теста: {{$test->name}}</h1>
                <p><span>Автор:</span> <a href="{{ asset('users/'.$who->id)}}">{{$who->name}}</a></p>
                <p><span>Тема:</span> {{$test->theme}}</p>
                <p><span>Предмет:</span> {{$lesson->name}}</p>   
                <p><span>Количество верных ответов:</span> </p>
            </div>
        </div>
    @elseif(Auth::user()->typeAdmin == 4)
    <div class="test-render">
        <div class="example">
            <h1>Название теста: {{$test->name}}</h1>
            <p><span>Автор:</span> <a href="{{ asset('users/'.$who->id)}}">{{$who->name}}</a></p>
            <p><span>Тема:</span> {{$test->theme}}</p>
            <p><span>Предмет:</span> {{$lesson->name}}</p>   
            <p><span>Количество вопросов:</span> {{$question}}</p>
            <p><span>Время на решение теста:</span> Часов: {{$test->hours}} Минут: {{$test->minutes}}</p>
        </div>
    </div>
    @endif
@else
    @if(Auth::user()->typeAdmin == 3 || Auth::user()->typeAdmin == 4)
    <div class="test-render">
        <div class="example">
            <h1>Название теста: {{$test->name}}</h1>
            <h2><span>Тест завершен</span></h2>
            <p><span>Автор:</span> <a href="{{ asset('users/'.$who->id)}}">{{$who->name}}</a></p>
            <p><span>Тема:</span> {{$test->theme}}</p>
            <p><span>Предмет:</span> {{$lesson->name}}</p>   
            <p><span>Количество верных ответов:</span>{{$count}}/{{$question}}  </p>
        </div>
    </div>
    @elseif(AUth::user()->typeAdmin == 2)
    <?php function findValue($id, $correct) {
        
        foreach($correct as $d) {
            if( $d->answer_id != $id ) continue;
            return $d->correct;
        }
        return ' ';
    } ?>
    <div class="test-render">
        <div class="example">   
            <h1>Название теста: {{$test->name}}</h1>
            <h2><span>Тест завершен</span></h2>
            <p><span>Автор:</span> <a href="{{ asset('users/'.$who->id)}}">{{$who->name}}</a></p>
            <p><span>Тема:</span> {{$test->theme}}</p>
            <p><span>Предмет:</span> {{$lesson->name}}</p>   
            <p><span>Количество верных ответов:</span> <span class="@if($count/$question*100>50) blue @else red @endif">{{$count}}/{{$question}}</span></p>
        </div>
    </div>
    <?php $num=0; ?>
    @foreach($quests as $objs)
    <?php $num++?>
    <div class="wrapped_question">
        <div class="question @if(!isset($questtype[$objs->id])) false-quest @else  correct-quest @endif">
        <div class="quest">
        <h3>Вопрос №{{$num}}</h3>
        <p> {{$objs->question}}</p>
        @if(substr($objs->include, -3)=='png'|| substr($objs->include, -3)=='jpg' || substr($objs->include, -3)=='gif')
                            
                                <img class="minimized addimg" src="{{ asset('docs/'.$objs->include) }}">
                @endif
        </div>
        <?php $numb = 0?>
        <div class="help">Выберите правильный ответ: </div>
        @foreach($answers[$objs->id] as $answer)
            <?php $numb++ ?>
            
            <div class="answer @if($answer->correct == 1) correct @endif @if(findValue($answer->id,$corrects[$objs->id])== "choose" && $answer->correct == 0) false  @endif">
                <label class="container">{{$numb}}. {{$answer->text}}
                    <span class="checkmark @if(findValue($answer->id,$corrects[$objs->id]) === 1) correct-choose @elseif(findValue($answer->id,$corrects[$objs->id]) === 0) false-choose @endif"></span>
                </label>
            
                @if(substr($answer->include, -3)=='png'|| substr($answer->include, -3)=='jpg' || substr($answer->include, -3)=='gif')
                            
                                <img class="minimized addimg" src="{{ asset('docs/'.$answer->include) }}">
                @endif
            </div>
        @endforeach

    </div>
    </div>
@endforeach
    @endif
@endif
@endsection