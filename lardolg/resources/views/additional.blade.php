@extends('layouts/navbar')
@section('content')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/additional.css')}}">
<div class="navigate">
    @if(Auth::user()->typeAdmin == 2)
    <a class="typejourn" href=makeadditional>Создать дополнительное занятие</a>
@endif
</div>


@if(count($additionals)==0)
    <h1 class="h1-high allert">Дополнительные занятия отсутвуют</h1>
@else
    <div class="container">
        
    <h1 class="h1-high">Дополнительные занятия</h1>
        
    @foreach($additionals as $additional)
    <div class="card">
        <div class="card-header">
            
            <div class="row">
                <div class="col-auto mr-auto"><h3 class="header-href">
                    @if(Auth::user()->typeAdmin == 2  || Auth::user()->typeAdmin == 1)
                    <a href="additional/{{$additional->id}}">{{$additional->theme}}</a>
                @else
                {{$additional->theme}}  
                    @endif
                </h3></div>
            <div class="col-auto">{{$d[$additional->id]}}</div>
              </div>
        </div>
        <div class="card-body">
        
        
        
            @if($additional->about != '')
                <p>Об уроке - {{$additional->about}}</p>
            @endif
            <div class="row">
                
                <div class="col-auto mr-auto">Автор - <a href="users/{{$additional->uid}}">{{$additional->name}}</a></div>
                
            <div class="col-auto @if($count[$additional->id] <= $additional->howmuch) text-primary  @else text-danger @endif">
                <span id="count">{{$count[$additional->id]}}</span>/{{$additional->howmuch}}
            </div>
            <div class="col-auto">{{$t[$additional->id]}}-{{$to[$additional->id]}}</div>
              </div>
        </div>
        @if(Auth::user()->typeAdmin == 3)
            <div class="card-footer">
                <div class="col admin"><button value="{{$who}}" data-id="{{$additional->id}}" class="admin-btn add-student">@if($who == 1) Отписаться@else Зарегистрироваться@endif</button> </div>
            </div> 
        @endif
        
        
    </div>
    @endforeach
    </div>
    
    @if(Auth::user()->typeAdmin == 3)
        <script src="js/additional.js"></script>
    @endif
@endif
@endsection