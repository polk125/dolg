@extends('layouts.navbar')

@section('content')
<link rel="stylesheet" href="css/alerts.css">

<h1 class="h1-high">Задолжности</h1>


@if(Auth::user()->typeAdmin==3)
<table class="table">
    <thead>
<tr>
    <th>Преподователь</th>
    <th>Предмет</th>
    <th>Тест</th>
    <th>Уч.Мат.</th>
    <th>Дата</th>
    <th>Причина</th>
    <th>Состояние</th>
</tr>
</thead>
@if(count($passes) > 0)
    @foreach($passes as $pass)
    <tbody>
    <tr>
    <td><a href="{{ asset('users/'.$teachers[$pass->id]->id)}}">{{$teachers[$pass->id]->name}}</a></td>
    <td>{{$lessons[$pass->id]->name}}</td>
    <td>
        <a href="{{ asset('start/'.$pass->id)}}">Перейти</a>
    </td>
    <td>
        <a href="{{ asset('materials/'.$pass->material_id)}}">Перейти</a>
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
<table class="table">
    <thead>
<tr>
    <th>Преподователь</th>
    <th>Ребенок</th>
    <th>Предмет</th>
    <th>Тест</th>
    <th>Уч.Мат.</th>
    <th>Дата</th>
    <th>Причина</th>
    <th>Состояние</th>
</tr>
</thead>
@if(count($passes) > 0)
    @foreach($passes as $pass)
    <tbody>
    <tr>
    <td><a href="{{ asset('users/'.$teachers[$pass->id]->id)}}">{{$teachers[$pass->id]->name}}</a></td>
    <td><a href="{{ asset('users/'.$names[$pass->id]->user_id)}}">{{$names[$pass->id]->fio}}</a></td>
    <td>{{$lessons[$pass->id]->name}}</td>
    <td>
        <a href="{{ asset('start/'.$pass->id)}}">Перейти</a>
    </td>
    <td>
        <a href="{{ asset('materials/'.$pass->material_id)}}">Перейти</a>
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
@elseif(Auth::user()->typeAdmin==2)
    <table class="table">
        <thead>
    <tr>
        <th>ФИО</th>
        <th>Класс</th>
        <th>Предмет</th>
        <th>Тест</th>
        <th>Уч.Мат.</th>
        <th>Дата</th>
        <th>Состояние</th>
        <th></th>
    </tr>
    </thead>
    @if(count($passes) > 0)
        
        @foreach($passes as $pass)
        
        <tbody>
        <tr id="{{$pass->id}}">
        <td><a href="{{ asset('users/'.$names[$pass->id]->user_id)}}">{{$names[$pass->id]->fio}}</a></td>
        <td>{{$classes[$pass->id]->number}}{{$classes[$pass->id]->type}}</td>
        <td>{{$lessons[$pass->id]->name}}</td>
        <td>
            @if($pass->tire == 2)
            @elseif($pass->tire == 0)
            <a href="{{ asset('tests/'.$pass->test_id)}}">Перейти</a>
            @else
            <a href="{{ asset('start/'.$pass->id)}}">Перейти</a>
            @endif
        </td>
        <td>
            <a href="{{ asset('materials/'.$pass->material_id)}}">Перейти</a>
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
            <button
            data-id="{{$pass->id}}"
            data-user="{{$names[$pass->id]->id}}"
            data-date="{{$pass->date}}"
            data-obj="{{$lessons[$pass->id]->id}}"
            id="save" title="Закрыть задолжность" type="button" class="close" >&times;</button >
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

@section('modal')
<link rel="stylesheet" href="css/alerts.css">
<div class="modal">
        <div class="modal__overlay"></div>
        <div class="modal__window">
            <h2 class="modal__title">Исправление задолженности</h2>
            <form name="modal_form" class="modal__text" method="post">
                    <div class="form-group">
                        <div class="input-group-my modal-input">
                        <label>Оценка</label>
                            <input type="text" name="modal_dolg" class="form-control modalInput">
                        </div>
                        <div class="modal_comment">
                            Введите оценку на которую хотите заменить данную задолжность.
                        </div>
                    </div>                    
                    <div class="form-group">
                        <input type="button" name="modal_submit" class="btn btn-outline-primary" value="ОК">
                    </div>
                    
                </form>
            <div class="modal__close-icon">
                <i class="far fa-window-close"></i>
            </div>
    </div>
</div>
<script src="js/jquery.js"></script>
<script src="js/deletePass.js"></script>
@endsection
