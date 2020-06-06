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
<div class="container">
    <h2 class="h1-high">
Задолженности учащихся
    </h2>
@if(count($classes)==0)
    <h3 class="allert h1-high">Нет классов.<h3>
@endif
@foreach ($classes as $class)
    <div class="card">
    <div class="card-header">
        <div class="row">
        <div class="col-auto mr-auto">
            <a href="{{asset('adminpanel/classes/'.$class->id)}}">{{$class->number}}{{$class->type}}</a></div>
    <div class="col-auto">@if($teacher[$class->id]!=NULL)<a href="{{asset('adminpanel/users/'.$teacher[$class->id]->id)}}">{{$teacher[$class->id]->name}}</a>@endif</div>
        </div>
    </div>
    @foreach($lessons[$class->id] as $lesson)
    <div class="card-header">
        <div class="row">
            <div class="col-auto mr-auto">
                {{$lesson->name}}</div>
        <div class="col-auto">@if($lesson->uname!=NULL)<a href="{{asset('adminpanel/users/'.$lesson->uid)}}">{{$lesson->uname}}</a>@endif</div>
            </div>
    </div>
    <div class="card-body">
        @if(count($pass[$class->id][$lesson->id])==0)
        Задолженностей нет.
        @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ученик</th>
                    <th scope="col">Оценка</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Состояние</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=0 ?>
                @foreach ($pass[$class->id][$lesson->id] as $p)
                <?php $num++ ?>
                <tr class="@if($p->tire==0) text-danger @elseif($p->tire==1) text-warning @else text-primary @endif">
                    <th scope="row">{{$num}}</th>
                    <td><a href="adminpanel/users/{{$p->user_id}}">{{$p->fio}}</a></td>
                    <td>{{$p->value}}</td>
                    <td>{{date('d.m.Y',strtotime($p->date))}}</td>
                    <td>@if($p->tire == 0)Ученик оповещен @elseif($p->tire==1)Ожидание проверки @elseif($p->tire==2)Закрыта@endif</td>
                </tr>      
                @endforeach
            </tbody>
            
        </table>
        @endif

    </div>
    @endforeach
    
    </div>
@endforeach
</div>
@endsection