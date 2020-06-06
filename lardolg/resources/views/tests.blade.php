@extends('layouts/navbar')

@section('content')
<link rel="stylesheet" href="css/test.css">
<link rel="stylesheet" href="css/journ.css">
@if(Auth::user()->typeAdmin==2)	
    <a class="typejourn" href=tests>Все тесты</a>
    <a class="typejourn" href=make_tests>Создать новый тест</a>
@endif
<h1 class="h1-high">Тесты</h1>



@if(count($tests)==0)
    <h1 class="h1-high allert">Тесты отсутвуют</h1>
@else
<form method="post" class="journ_month" id="MyForm">
    Предмет
    {{csrf_field()}}
    <select name="object" onchange="document.getElementById('MyForm').submit()">
    <option value="all">Все предметы</option>
    
    @foreach ($lessons as $lesson)
        <option @if(isset($object))@if($object==$lesson->id) selected @endif @endif    value='{{$lesson->id}}'>
            <?=$lesson->name?>
        </option>
    @endforeach	

    </select>
</form>
@foreach($tests as $test)
<div class="test" ><a class="header-href" href="tests/{{$test->id}}">{{$test->name}}</a>
    
    <p>Тема - {{$test->theme}}</p>

    <p>Автор: @if(isset($names[$test->id]->name)) {{$names[$test->id]->name}} @else Неизвестный автор @endif</p>
    @foreach($lessons as $lesson)
        @if($lesson->id == $test->lessonid)
            <p>Предмет - {{$lesson->name}}</p><br>
        @endif
    @endforeach
    @if(substr($test->include, -3)=='png'|| substr($test->include, -3)=='jpg')
        <a class="header-img" href="tests/{{$test->id}}"><img  src='docs/{{$test->include}}' ></a>
    @endif

    <br><div class="nav-test"><a class="look" href="editTest/{{$test->id}}">Редактировать</a><a class="look" href="tests/{{$test->id}}">Просмотр</a></div>
</div>
@endforeach
@endif
@endsection