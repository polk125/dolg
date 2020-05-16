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
    <td>{{$teachers[$pass->id]->name}}</td>
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
<table class="table">
    <thead>
<tr>
    <th>Преподователь</th>
    <th>Ребенок</th>
    <th>Предмет</th>
    <th>ССылка</th>
    <th>Дата</th>
    <th>Причина</th>
    <th>Состояние</th>
    <th></th>
</tr>
</thead>
@if(count($passes) > 0)
    @foreach($passes as $pass)
    <tbody>
    <tr>
    <td>{{$teachers[$pass->id]->name}}</td>
    <td>{{$names[$pass->id]->fio}}</td>
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
        <tr id="{{$pass->id}}">
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
