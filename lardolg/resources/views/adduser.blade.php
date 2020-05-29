@extends('layouts/navbar')
@section('content')
<a href="{{ asset('adminpanel/add') }}">
    Добавление Пользователей
</a>    
<a href="{{ asset('adminpanel/addclasses') }}">
    Добавление Классов
</a>
<a  href="{{ asset('adminpanel/classes') }}">
    Редактирование классов
</a>
<a href="{{ asset('adminpanel/lessons') }}">
    Настройка предметов
</a>
@if(session('errors'))
    @foreach ($errors as $error)
        {{$error}}
    @endforeach
@endif
@if(session('success'))
    {{session('success')}}
@endif
<br><br>
<form action="{{url('/adminpanel/add/uploadexcel')}}" method="post" enctype="multipart/form-data">
@csrf
    Выберите файл для добавления Пользователей
    <br><br>
    <input type="file" id="file" name="file">
    <button type="submit">Загрузить пользователей</button>

</form>
@endsection