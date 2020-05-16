@extends('layouts.navbar')
@section('content')
<link rel="stylesheet" href="{{ asset('css/test.css')}}">
<link rel="stylesheet" href="{{ asset('css/journ.css')}}">

<a class="typejourn" href=../tests>Назад</a>
<div class="test-render">
    <div class="example">
        <h1>Название теста: {{$test->name}}</h1>
        <p>Автор: {{$who->name}}</p>
        <p>Тема: {{$test->theme}}</p>
        <p>предмет: {{$lesson->name}}</p>
        @if(substr($test->include, -3)=='png'|| substr($test->include, -3)=='jpg')
            <img  src="{{ asset('docs/'.$test->include) }}">
        @endif       
    </div>
    <?php $num = 0?>
@foreach($question as $objs)
    <?php $num++?>

    <div class="question">
    <h3>Вопрос №{{$num}}: {{$objs->question}}</h3>
 
    <?php $numb = 0?>
    @foreach($answers[$objs->id] as $answer)
        <?php $numb++ ?>
        @if($answer->correct==1)
            <div class="answer correct">Ответ {{$numb}}: {{$answer->text}} (правильный)<br>
            @if(substr($answer->include, -3)=='png'|| substr($answer->include, -3)=='jpg')
                    
                    <img  src="{{ asset('docs/'.$answer->include) }}" >
            @endif
            </div>
        @else
            <div class="answer ">Ответ {{$numb}}: {{$answer->text}}</div>
            @if(substr($answer->include, -3)=='png'|| substr($answer->include, -3)=='jpg')
                        
                            <img  src="{{ asset('docs/'.$answer->include) }}">
            @endif      
        @endif
    @endforeach

    </div>

@endforeach
</div>
@endsection