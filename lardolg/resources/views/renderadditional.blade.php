@extends('layouts/navbar')
@section('content')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/additional.css')}}">
<div class="navigate">
<a class="typejourn" href="{{ asset('makeadditional')}}">Создать дополнительное занятие</a>
<a class="typejourn" href="{{ asset('additional')}}">Назад</a>
</div>
<div class="container">
        
        
    <div class="card">
        <div class="card-header">
            
            <div class="row">
                <div class="col-auto mr-auto"><h3 class="header-href">{{$additional->theme}}</h3></div>
               
            <div class="col-auto">{{$d}}</div>
              </div>
        </div>
        <div class="card-body">
        
        
        
            @if($additional->about != '')
                <p>Об уроке - {{$additional->about}}</p>
            @endif
            <div class="row">
                <div class="col-auto mr-auto">Автор - <a href="{{asset('users/'.$additional->uid)}}">{{$additional->name}}</a></div>
            <div class="col-auto @if(count($count) <= $additional->howmuch) blue @else red @endif">
                {{count($count)}}/{{$additional->howmuch}}
            </div>
            <div class="col-auto">{{$t}}-{{$to}}</div>
              </div>
        </div>
            <div class="card-header">
            
              Список учеников
          </div>
          <div class="card-body">
              @if(count($count)>0)
              <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ученик</th>
                        <th scope="col">Класс</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $num=0 ?>
                    @foreach ($count as $c)
                    <?php $num++ ?>
                        <tr>
                            <th scope="row">{{$num}}</th>
                            <td><a href="users/{{$c->student_id}}">{{$c->fio}}</a></td>
                            <td>{{$c->number}}{{$c->type}}</td>
                        </tr>      
                    @endforeach
                    @endif
                </tbody>
                
            </table>
          </div>
        </div>
        
    </div>
    </div>
@endsection