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
@endsection