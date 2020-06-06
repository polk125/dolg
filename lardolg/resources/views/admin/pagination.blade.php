


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
  <table class="table">

<thead class="thead-light">
  <tr> 
  <th scope="col">#</th>
    <th scope="col">ФИО</th>
    <th scope="col">Роль пользователя</th>
    <th>Удалить</th>
  </tr>
</thead>
<tbody>
<?php $num=0?>
@foreach($users as $user)
<?php $num++?>
  <tr>
  <td>{{$num}}</td>
     <td><a href="{{ asset('adminpanel/users/'.$user->id)}}">{{$user->name}}</a></td>
     <td>@if($user->typeAdmin == 1)Администратор@elseif($user->typeAdmin == 2)Учитель@elseif($user->typeAdmin == 3)Ученик@elseif($user->typeAdmin == 4)Родитель@endif</td>
    <td><button
      data-id="{{$user->id}}"
      id="save" title="Закрыть задолжность" type="button" class="close" >&times;</button ></td>
    </tr>
  @endforeach
</tbody>
</table>
{{$users->links()}}
</div>


<script src="{{ asset('js/pagination.js')}}"></script>

@endsection