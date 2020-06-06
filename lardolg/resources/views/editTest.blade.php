@extends('layouts.navbar')

@section('content')
<link rel="stylesheet" href="{{ asset('css/img.css')}}">
<link rel="stylesheet" href="{{ asset('css/editTest.css')}}">
<link rel="stylesheet" href="{{ asset('css/journ.css')}}">


<a class="typejourn" href={{ asset('tests')}}>Назад</a>
<div class="test-render">
    <div class="example">
        <div class="new">
        <label for="new-name">Название теста: </label>
        <input type="text" class="new-name" value="{{$test->name}}">
        <button value="{{$test->id}}" disabled class="admin-btn edit-new-name">Сохранить</button>
        <label for="new-content">Тема:</label>
        <input type="text" class="new-theme" value="{{$test->theme}}">
        <button value="{{$test->id}}" disabled class="admin-btn edit-new-theme">Сохранить</button><br>
        <label for="new-content"> Предмет:</label>
        <select class="new-lesson" name="new-lesson" value="{{$test->lessonid}}">
            @foreach($lessons as $lesson)
            <option value="{{$lesson->id}}"
            @if($lesson->id == $test->lessonid)    
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
                <img src="{{ asset('docs/'.$test->include) }}" class="minimized" alt="клик для увеличения" />
            </div>
                @else
                <br>
                <div class="addedimg">
                <h4>{{$test->include}}</h4>
                <a class="typejourn" href="{{ asset('docs/'.$test->include)}}">Перейти</a>
                <a class="typejourn" href="{{ asset('download/'.$test->include)}}">Скачать</a>
            </div>  
            @endif
        @else
            <div class="addedimg"></div>
        @endif
            <label for="question_img">Изменить загружаемый файл: </label> 
            <input class="input-new" type="file" name="test_load" id="question_img"><br>
            <button value="{{$test->id}}" class="admin-btn edit-img-test">Сохранить</button> 
            <button value="{{$test->id}}" class="admin-btn delete-img-test">Удалить файл</button><br>  <br>      
        
        <p>Автор: @if(isset($who->name)) <a href="{{ asset('users/'.$who->id)}}">{{$who->name}}</a> @else Неизвестный автор @endif</p>
    </div>
    <?php $num = 0?>
@foreach($question as $objs)
    <?php $num++?>

    <div class="question">
        <label for="new-question">Вопрос №{{$num}}: </label>
        <textarea class="new-question" value="{{$objs->question}}">{{$objs->question}}</textarea>
        <button value="{{$objs->id}}" disabled class="admin-btn edit-new-question">Сохранить</button><br>
        @if($objs->include!=NULL)
            @if(substr($objs->include, -3)=='png'|| substr($objs->include, -3)=='jpg' || substr($objs->include, -3)=='gif')
            <div class="addedimgadd{{$objs->id}}">
                <img  class="minimized addimg" src="{{ asset('docs/'.$objs->include) }}" >
            </div>
            @else
            <div class="addedimgadd{{$objs->id}}">
                <br>
                <h1>{{explode(".", $objs->include)[0]}}</h1>
                <a class="typejourn" href="{{ asset('docs/test/'.$objs->include)}}">Перейти</a>
                <a class="typejourn" href="{{ asset('download/test/'.$objs->include)}}">Скачать</a>
            </div>
            @endif
        @else
            <div class="addedimgadd{{$objs->id}}"></div>
        @endif
        <label for="add_img">Изменить загружаемый файл: </label> 
        <input class="input-add-new" type="file" name="test_load" id="add_img" data-id="{{$objs->id}}"><br>
        <button value="{{$objs->id}}" id="add{{$objs->id}}" class="admin-btn edit-img-add">Сохранить</button>
        <button value="{{$objs->id}}" class="admin-btn delete-img-add">Удалить файл</button><br>


    <?php $numb = 0?>
    @foreach($answers[$objs->id] as $answer)
        <?php $numb++ ?>
        @if($answer->correct==1)
        <div class="answer correct">
        <label for="new-answer">Ответ {{$numb}}: </label>
        <input class="new-answer" value="{{$answer->text}}">
        <input type="checkbox" class="new-correct" checked data-correct="{{$answer->correct}}"><label>Верный ответ</label>
        <button value="{{$answer->id}}" class="admin-btn edit-new-answer">Сохранить</button><br>
        @if($answer ->include!=NULL)

            @if(substr($answer->include, -3)=='png'|| substr($answer->include, -3)=='jpg' || substr($answer->include, -3)=='gif')
            <div class="addansimg{{$answer->id}}">
                <img  class="minimized addimg" src="{{ asset('docs/'.$answer->include) }}" >
            </div>
            @else
            <div class="addansimg{{$answer->id}}">
                <br>
                <h1>{{explode(".", $answer->include)[0]}}</h1>
                <a class="typejourn" href="{{ asset('docs/'.$answer->include)}}">Перейти</a>
                <a class="typejourn" href="{{ asset('download/'.$answer->include)}}">Скачать</a>
            </div>
            @endif
        @else
            <div class="addansimg{{$answer->id}}"></div>
        @endif
            <label for="add_img">Изменить загружаемый файл: </label> 
            <input class="input-ans" type="file" name="test_load" id="add_img" data-id="{{$answer->id}}">
            <button value="{{$answer->id}}" id="addans{{$answer->id}}" class="admin-btn edit-img-ans">Сохранить</button>
            <button value="{{$answer->id}}" class="admin-btn delete-img-ans">Удалить файл</button><br></div>
        @else
        <div class="answer">
            <label for="new-answer">Ответ {{$numb}}: </label>
            <input class="new-answer" value="{{$answer->text}}">
            <input type="checkbox" class="new-correct" data-correct="{{$answer->correct}}"><label>Верный ответ</label>
            <button value="{{$answer->id}}" class="admin-btn edit-new-answer">Сохранить</button><br>
            @if($answer ->include!=NULL)

                @if(substr($answer->include, -3)=='png'|| substr($answer->include, -3)=='jpg' || substr($answer->include, -3)=='gif')
                <div class="addansimg{{$answer->id}}">
                    <img  class="minimized addimg" src="{{ asset('docs/'.$answer->include) }}" >
                </div>
                @else
                <div class="addansimg{{$answer->id}}">
                    <br>
                    <h1>{{explode(".", $answer->include)[0]}}</h1>
                    <a class="typejourn" href="{{ asset('docs/'.$answer->include)}}">Перейти</a>
                    <a class="typejourn" href="{{ asset('download/'.$answer->include)}}">Скачать</a>
                </div>
                @endif
            @else
                <div class="addansimg{{$answer->id}}"></div>
            @endif  
            <label for="add_img">Изменить загружаемый файл: </label> 
            <input class="input-ans" type="file" name="test_load" id="add_img" data-id="{{$answer->id}}">
            <button value="{{$answer->id}}" id="addans{{$answer->id}}" class="admin-btn edit-img-ans">Сохранить</button>
            <button value="{{$answer->id}}" class="admin-btn delete-img-ans">Удалить файл</button><br>
        </div>    
        @endif
    @endforeach

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
<script src="{{ asset('js/editTest.js')}}"></script>
<script src="{{ asset('js/img.js')}}"></script>
@endsection