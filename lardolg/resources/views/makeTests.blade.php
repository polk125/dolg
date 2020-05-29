@extends('layouts/navbar')

@section('content')
<link rel="stylesheet" href="css/test.css">
<link rel="stylesheet" href="css/journ.css">
<a class="typejourn" href=tests>Все тесты</a>
<a class="typejourn" href=make_tests>Создать новый тест</a>
<h1 class="h1-high">Создание теста</h1>
@if(!isset($request))
    <form id="addadminch" class="admin-test-form" enctype="multipart/form-data" action="make_tests" method="POST">
    <label for="name">Название теста*</label>
    <input type="text" name="name" id="login" required><br>
	<label for="name">Тема*</label>
    <input type="text" name="theme" id="login" required><br>
    <label for="number">Количество вопросов*</label>
    <input type="number" min="1" value="1" name="number" id="login" required><br>

    
    <label for="obj" >Предмет*</label>
    <select name="obj" required>
    @foreach($objs as $obj)
        <option value="{{$obj->id}}">{{$obj->name}}</option>
    @endforeach			
    </select><br>
    <p>Время на выполнение:</p>
    <label for="hours" >Часов*</label>
    <input type="number" min="0" max="24" value="0" name="hours" id="hours" required><br>
    <label for="minutes" >Минут*</label>
    <input type="number" min="0" max="59" value="00" name="minutes" id="minutes" required><br>
    <label for="img"0>Загружаемые файлы</label> 
    <input class="load" type="file" name="test_load" id="question_img"><br>
    <p>* - обязательные поля</p>
    <input class="admin-btn" type="submit" value="Создать">
    {{csrf_field()}}
    </form>    
@else
    <script src="js/jquery.js"></script>
    <script src="js/add_test.js"></script>

    
        <div class="new-test"><p>Тест: {{$request->name}} </p>
        <form  class="form-question" name="form_question" enctype="multipart/form-data" action="make_tests/add" method="POST">
            {{csrf_field()}}
        <div id="add_field_area" class="add_field_area">
        <input type="hidden" name="test_name" value="{{$request->name}}"/>
        <input type="hidden" name="test_theme" value="{{$request->theme}}"/>
        <input type="hidden" name="quest_type"  value="{{$request->obj}}"/>
        <input type="hidden" name="quest_load"  value="{{$load}}"/>
        <input type="hidden" name="test_hours"  value="{{$request->hours}}"/>
        <input type="hidden" name="test_minutes"  value="{{$request->minutes}}"/>
        @for($question=1; $question<=$request->number; $question++)
            @if($question==1)
    
                <div id="add1" class="add">
                        <label> Вопрос №1</label><br>
                        <textarea  type="text"name="question1" id="val"></textarea><br>
                        <label for="img"0>Загружаемые файлы для вопроса</label> 
                        <input class="load" type="file" name="question<?=$question?>_img" id="question<?=$question?>_img">
                  
            
            @else
            
        <div id="add<?=$question?>" class="add"><hr>
                        <label> Вопрос №<?=$question?></label><br>
                        <textarea type="text" name="question<?=$question?>" id="val"  value=""></textarea><br>
                        <div class="deletebutton" onclick="deleteField(<?=$question?>);"></div>
                        <label for="img"0>Загружаемые файлы для вопроса</label> 
                        <input class="load" type="file" name="question<?=$question?>_img" id="question<?=$question?>_img">
                        
                    
        
        @endif
        @for($answer=1; $answer<=2; $answer++)
            <div class="answer" id="answer{{$answer}}"><label for="answer">Ответ: {{$answer}} </label><input type=text id="question{{$question}}" name="question{{$question}} answer{{$answer}}">
            <input type="checkbox" class="correct" name="question{{$question}}_answer{{$answer}}_correct" id="question{{$question}}_answer{{$answer}}_correct"><label>Верный ответ</label>
            <br><label for="img"0>Загружаемые файлы для ответа</label> <input class="load" type="file" name="question{{$question}}_answer{{$answer}}_img" id="question{{$question}}_answer{{$answer}}_img"></div>
            
        @endfor
        
        </div>
        
        <div id="delete<?=$question?>" onclick="addFieldAnswer(<?=$question?>);" class="addbutton">Добавить новый ответ</div>
        
        @endfor
    

    
        </div><div onclick="addField();" class="addbutton">Добавить новый вопрос</div>
            <input name="quest-submit" class="admin-btn" type="submit" value="Создать">
            </form></div>
            



@endif
@endsection