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
<div class="row align-items-center head-navigation">
  <div class="col">
    <a href="{{ asset('adminpanel/addlesson') }}">
      Добавить предмет
    </a>    
      </div>
    </div>
<div class="container">
  <table class="table">

<thead class="thead-light">
  <tr> 
  <th scope="col">#</th>
    <th scope="col">Предмет</th>
    <th scope="col">Начиная с</th>
    <th scope="col">По</th>
    <th scope="col">Удалить</th>
  </tr>
</thead>
<tbody>
  <?php $num=0?>
@foreach($lessons as $lesson)
<?php $num++?>
  <tr>
  <td>{{$num}}</td>
  <td>{{$lesson->name}}</td>
  <td>{{$lesson->start}}</td>
  <td>{{$lesson->end}}</td>
  <td><button
    data-id="{{$lesson->id}}"
    id="save" title="Закрыть задолжность" type="button" class="close" >&times;</button ></td>
  </tr>
  @endforeach
</tbody>
</table>
</div>

<script src="{{ asset('js/delete_lesson.js')}}"></script>
@endsection