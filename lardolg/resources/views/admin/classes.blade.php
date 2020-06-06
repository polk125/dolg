
@extends('layouts.navbar')
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
  <div class="container">
    @if(count($classes)==0)
    <h3 class="allert h1-high">Нет классов.<h3>
  @else
    <table class="table">
  
  <thead class="thead-light">
    <tr> 
    <th scope="col">#</th>
      <th scope="col">Класс</th>
      <th scope="col">Учитель</th>
      <th scope="col">Удалить</th>
    </tr>
  </thead>
  <tbody>
    <?php $num=0?>
  @foreach($classes as $classe)
  <?php $num++?>
    <tr>
    <td>{{$num}}</td>
    <td><a href="{{ asset('adminpanel/classes/'.$classe->id)}}">{{$classe->number}}{{$classe->type}}</a></td>
    <td>@if(isset($teachers[$classe->id]))<a href="{{ asset('adminpanel/users/'.$teachers[$classe->id]->id)}}">{{$teachers[$classe->id]->name}}</a>@endif</td>
    <td><button
      data-id="{{$classe->id}}"
      id="save" title="Закрыть задолжность" type="button" class="close" >&times;</button ></td>
    </tr>
  </tr>
    @endforeach
  </tbody>
  </table>
  @endif
  </div>
  
  <script src="{{ asset('js/deleteclasses.js')}}"></script>
@endsection