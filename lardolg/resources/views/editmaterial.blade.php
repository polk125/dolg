@extends('layouts.navbar')
@section('content')
<link rel="stylesheet" href="{{ asset('css/material.css')}}">
<link rel="stylesheet" href="{{ asset('css/journ.css')}}">
<link rel="stylesheet" href="{{ asset('css/img.css')}}">
<a class="typejourn" href={{ asset('materials')}}>Назад</a>
<div class="test-render">
    <div class="example">
        <div class="example">
            <div class="new">
            <label for="new-name">Учебный материал:: </label>
            <input type="text" class="new-name" value="{{$test->name}}">
            <button value="{{$test->id}}" disabled class="admin-btn edit-new-name">Сохранить</button>
            <label for="new-content">Тема:</label>
            <input type="text" class="new-theme" value="{{$test->theme}}">
            <button value="{{$test->id}}" disabled class="admin-btn edit-new-theme">Сохранить</button>
            <br>
            <label for="new-content"> Предмет:</label>
            <select class="new-lesson" name="new-lesson" value="{{$test->lesson_id}}">
                @foreach($lessons as $lesson)
                <option value="{{$lesson->id}}"
                    @if($lesson->id == $test->lesson_id)    
                    selected
                @endif
                    >{{$lesson->name}}</option>
                @endforeach			
            </select>
            <button value="{{$test->id}}" class="admin-btn edit-new-lesson">Сохранить</button><br><br>
            <button class="admin-btn del-new" value="{{$test->id}}">Удалить тест</button>
            </div>
            @if($test->include!=NULL)
            @if(substr($test->include, -3)=='png'|| substr($test->include, -3)=='jpg' || substr($test->include, -3)=='gif')
            <div class="addedimg">
                <img src="{{ asset('docs/materials/'.$test->include) }}" class="minimized" alt="клик для увеличения" />
            </div>
                @else
                <br>
                <div class="addedimg">
                <h4>{{$test->include}}</h4>
                <a class="typejourn" href="{{ asset('docs/material/'.$test->include)}}">Перейти</a>
                <a class="typejourn" href="{{ asset('download/materials/'.$test->include)}}">Скачать</a>
            </div>
            @endif      
            @else     
            <div class="addedimg"></div>
            @endif  
            <label for="question_img">Изменить загружаемый файл: </label> 
            <input class="input-new" type="file" name="test_load" id="question_img"><br>
            <button value="{{$test->id}}" class="admin-btn edit-img-material">Сохранить</button>
            <button value="{{$test->id}}" class="admin-btn delete-img-material">Удалить файл</button><br>
            <p>Автор: <a href="{{ asset('users/'.$who->id)}}">{{$who->name}}</a></p>
            
    </div>
    <?php $num = 0?>
@foreach($question as $objs)
    <?php $num++?>

    <div class="question">
    <h3>Дополнительный материал №{{$num}}: 
    </h3>   
        @if(substr($objs->include, -3)=='png'|| substr($objs->include, -3)=='jpg' || substr($objs->include, -3)=='gif')
        <div class="addedimgadd{{$objs->id}}">
            <img  class="minimized addimg" src="{{ asset('docs/materials/'.$objs->include) }}" >
        </div>
        @else
        <div class="addedimgadd{{$objs->id}}">
            <br>
            <h1>{{explode(".", $objs->include)[0]}}</h1>
            <a class="typejourn" href="{{ asset('docs/material/'.$objs->include)}}">Перейти</a>
            <a class="typejourn" href="{{ asset('download/materials/'.$objs->include)}}">Скачать</a>
        </div>
        @endif
        
    
        <label for="add_img">Изменить загружаемый файл: </label> 
        <input class="input-add-new" type="file" name="test_load" id="add_img" data-id="{{$objs->id}}"><br>
        <button value="{{$objs->id}}" id="add{{$objs->id}}" class="admin-btn edit-img-add">Сохранить</button>
        <button value="{{$objs->id}}" class="admin-btn delete-img-add">Удалить файл</button><br>
    </div>

@endforeach
</div>
@endsection
@section('modal')
<div class="modal">
        <div class="modal__alert">
            <h2 class="modal__title">Сохранение изменений</h2>
    </div>
</div>
<script src="{{ asset('js/jquery.js')}}"></script>
<script src="{{ asset('js/img.js')}}"></script>
<script src="{{ asset('js/edit_file.js')}}"></script>
@endsection