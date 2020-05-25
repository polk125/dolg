@if(substr($load, -3)=='png' || substr($load, -3)=='jpg' || substr($load, -3)=='gif')
    <img src="{{ asset('docs/materials/'.$load) }}" class="minimized" alt="клик для увеличения">
@else
    <h4>{{$load}}</h4>
    <a class="typejourn" href="{{ asset('docs/material/'.$load)}}">Перейти</a>
    <a class="typejourn" href="{{ asset('download/materials/'.$load)}}">Скачать</a>
@endif