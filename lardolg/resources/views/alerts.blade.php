@extends('layouts.navbar')

@section('content')

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/alerts.css">
<h1 class="h1-high">Задолжности</h1>


@if(Auth::user()->typeAdmin==3)
<table class="table">
    <thead>
<tr>
    <th>Преподователь</th>
    <th>Класс</th>
    <th>Предмет</th>
    <th>ССылка</th>
    <th>Дата</th>
    <th>Причина</th>
    <th>Состояние</th>
</tr>
</thead>
@if(count($passes) > 0)
    @foreach($passes as $pass)
    <tbody>
    <tr>
    <td>{{$names[$pass->id]->name}}</td>
    <td>{{$classes[$pass->id]->number}}{{$classes[$pass->id]->type}}</td>
    <td>{{$lessons[$pass->id]->name}}</td>
    <td>
        {{-- {{$pass->include}} --}}
    </td>
    <td>{{$pass->date}}</td>
    <td>{{$pass->why}}</td>
    <td>Ожидание</td>
    </tr>
    </tbody>

@endforeach
</table>
@else

    </table>
    <p class="anons">У вас нет задолженностей</p>
@endif
@elseif(Auth::user()->typeAdmin==4)

@elseif(Auth::user()->typeAdmin==2)
    <table class="table">
        <thead>
    <tr>
        <th>ФИО</th>
        <th>Класс</th>
        <th>Предмет</th>
        <th>ССылка</th>
        <th>Дата</th>
        <th>Состояние</th>
        <th></th>
    </tr>
    </thead>
    @if(count($passes) > 0)
        
        @foreach($passes as $pass)
        
        <tbody>
        <tr>
        <td>{{$names[$pass->id]->fio}}</td>
        <td>{{$classes[$pass->id]->number}}{{$classes[$pass->id]->type}}</td>
        <td>{{$lessons[$pass->id]->name}}</td>
        <td>
            {{-- {{$pass->include}} --}}
        </td>
        <td>{{$pass->date}}</td>
        
        <td>
            @if($pass->tire==0)
                Оповещен
            @elseif($pass->tire==1)
                Сделал тест
            @endif
        </td>
        <td>
            <button title="Закрыть задолжность" type="button" class="close" >&times;</button >
        </td>
        </tr>
        </tbody>
        
    @endforeach
    </table>
    @else

        </table>
        <p class="anons">Присланных работ нет</p>
    @endif
@endif
@endsection