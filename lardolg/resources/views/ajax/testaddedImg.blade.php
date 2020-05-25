@if(substr($load, -3)=='png' || substr($load, -3)=='jpg' || substr($load, -3)=='gif')
    <img src="{{ asset('docs/'.$load) }}" class="minimized addimg" alt="клик для увеличения">
@else
    <h4>{{$load}}</h4>
    <a class="typejourn" href="{{ asset('docs/'.$load)}}">Перейти</a>
    <a class="typejourn" href="{{ asset('download/'.$load)}}">Скачать</a>
@endif