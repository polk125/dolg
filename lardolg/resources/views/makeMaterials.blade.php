@extends('layouts/navbar')

@section('content')
<link rel="stylesheet" href="css/test.css">
<link rel="stylesheet" href="css/journ.css">
<a class="typejourn" href=materials>Все учебные материалы</a>
<a class="typejourn" href=make_tests>Добавить учебный материал</a>
<h1 class="h1-high">Добавить материал</h1>
@if(!isset($request))
    <form id="addadminch" class="admin-test-form" enctype="multipart/form-data" action="make_materials" method="POST">
    <label for="name">Название материала*</label>
    <input type="text" name="name" id="login" required><br>
    <label for="name">Тема*</label>
    <input type="text" name="theme" id="login" required><br>
    <label for="obj" >Предмет*</label>  
    <select name="obj" required>
    @foreach($objs as $obj)
        <option value="{{$obj->id}}">{{$obj->name}}</option>
    @endforeach			
    </select><br>
    <label for="question_img">Загружаемые файлы</label> 
    <input class="load" type="file" name="test_load" id="question_img"><br>
    <label for="number">Доплнительные вложения</label>
    <input id="check" type="checkbox" name="check"  onclick="if(this.checked){document.querySelector('.includes').style.display=''}else {document.querySelector('.includes').style.display='none'}"><br>
    <div class="includes" style="display:none;">
    <label for="number">Количество вложений</label>
    
    <input type="number" min="1" value="1" name="number" id="login" required><br>
    </div>
    <p>* - обязательные поля</p>
    <input class="admin-btn" type="submit" value="Создать">
    {{csrf_field()}}
    </form>    
@else
    <script src="js/jquery.js"></script>
    <script src="js/add_mat.js"></script>

    
        <div class="new-test"><p>Учебный материал: {{$request->name}} </p>
        <form  class="form-question" name="form_question" enctype="multipart/form-data" action="make_materials/add" method="POST">
            {{csrf_field()}}
        <div id="add_field_area" class="add_field_area">
        <input type="hidden" name="test_name" value="{{$request->name}}"/>
        <input type="hidden" name="test_theme" value="{{$request->theme}}'"/>
        <input type="hidden" name="quest_type"  value="{{$request->obj}}"/>
        <input type="hidden" name="quest_load"  value="{{$load}}"/>
        @for($question=1; $question<=$request->number; $question++)
            @if($question==1)
    
                <div id="add1" class="add">
                        <label for="img"0>Загружаемый файл №1:</label> 
                        <input class="load" type="file" name="question<?=$question?>_img" id="question<?=$question?>_img">
                </div>
            @else
                <div id="add<?=$question?>" class="add"><hr>
                    <div class="deletebutton" onclick="deleteField(<?=$question?>);"></div>
                    <label for="img"0>Загружаемый файл №<?=$question?>:</label>
                    <input class="load" type="file" name="question<?=$question?>_img" id="question<?=$question?>_img">
                </div>
                            
                        
            
            @endif
        @endfor

        </div><div onclick="addField();" class="addbutton">Добавить материала</div>
            <input name="quest-submit" class="admin-btn" type="submit" value="Создать">
            </form></div>
            



@endif
@endsection