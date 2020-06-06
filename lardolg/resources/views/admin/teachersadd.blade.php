@extends('layouts/navbar')
@section('content')

<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/admin.css')}}">
<div class="row align-items-center head-navigation">
    <div class="col">
<a href="{{ asset('adminpanel/add') }}">
    Добавление Пользователей
</a>    
    </div>
    <div class="col">
<a href="{{ asset('adminpanel/users') }}">
    Все пользователи
</a>
    </div>
<div class="col">
<a  href="{{ asset('adminpanel/classes') }}">
    Редактирование классов
</a>
</div>
<div class="col">
<a href="{{ asset('adminpanel/lessons') }}">
    Настройка предметов
</a>
</div>
</div>
<?php $num=0; ?>
@isset($errorinsert)
    @foreach ($errorinsert as $item)
        {{$item}}
    @endforeach
@endisset
@isset($errorinsert)
    @foreach ($errorinsert as $item)
        {{$item}}
    @endforeach
@endisset
<table class="table">
@foreach ($collection as $item)

<?php $num++ ?>
@if ($num == 1)
<thead>
    <tr>
        <th scope="col">ФИО*</th>
        <th scope="col">Email</th>
        <th scope="col">Логин*</th>
        <th scope="col">Телефон</th>
        <th scope="col">пароль</th>
        <th scope="col">Добавление</th>
        
    </tr>
    </thead>
    <tbody>
@else

        <tr>
            <th scope="col">{{$item[0]}}</th>
            <th scope="col">{{$item[1]}}</th>
            <th scope="col">{{$item[2]}}</th>
            <th scope="col">{{$item[3]}}</th>
            <th scope="col">{{$item[4]}}</th>
            <th scope="col">@isset($item[5])
                {{$item[5]}}
            @else Не добавлено @endisset</th>
        </tr>
   
@endif



@endforeach
</tbody>
</table> 
<div class="row align-items-center head-navigation">
    <div class="col">
        <a class="typejourn" href={{ asset('download/result/'.$url)}}>Скачать Результаты</a>
    </div>
</div>
@endsection