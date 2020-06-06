@extends('layouts/navbar')

@section('content')
<link rel="stylesheet" href="css/test.css">
<link rel="stylesheet" href="css/journ.css">
@if(Auth::user()->typeAdmin==2)	
    <a class="typejourn" href=materials>Все материалы</a>
    <a class="typejourn" href=make_materials>Добавить новый материал</a>
@endif
<h1 class="h1-high">Материалы</h1>



@if(count($materials)==0)
    <h1 class="h1-high allert">Материалы отсутвуют</h1>
@else
<form method="post" class="journ_month" id="MyForm">
    Предмет
    {{csrf_field()}}
    <select name="object" onchange="document.getElementById('MyForm').submit()">
    <option value="all">Все предметы</option>
    
    @foreach ($lessons as $lesson)
        <option @if(isset($object))@if($object==$lesson->id) selected @endif @endif value='{{$lesson->id}}'>
            <?=$lesson->name?>
        </option>
    @endforeach	

    </select>
</form>
@foreach($materials as $material)
<div class="test" ><a class="header-href" href="materials/{{$material->id}}">{{$material->name}}</a>
    
    <p>Тема - {{$material->theme}}</p>

    <p>Автор: {{$names[$material->id]->name}}</p>
    @foreach($lessons as $lesson)
        @if($lesson->id == $material->lesson_id)
            <p>Предмет - {{$lesson->name}}</p><br>
        @endif
    @endforeach
    @if(substr($material->include, -3)=='png'|| substr($material->include, -3)=='jpg')
        <a class="header-img" href="materials/{{$material->id}}"><img  src='docs/{{$material->include}}' ></a>
    @endif

    <br><div class="nav-test">
        @if(Auth::user()->typeAdmin!=4 || Auth::user()->typeAdmin!=3)<a class="look" href="editmaterial/{{$material->id}}">Редактировать</a>@endif<a class="look" href="materials/{{$material->id}}">Просмотр</a></div>
</div>
@endforeach
@endif
@endsection