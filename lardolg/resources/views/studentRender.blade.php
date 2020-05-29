@extends('layouts/navbar')
@section('content')
    
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">

<div class="profile"><div class="header"><h1>Профиль</h1>
    <h5>{{$student->fio}}</h5>
    <h6>Роль: @if($student->gender == "м")ученик @else ученица@endif</h6>
    <h6>Родитель: @if(isset($parent))<a href="{{ asset('users/'.$parent->id)}}">{{$parent->name}}</a>@endif</h6>
    </div>
    <div class="content">
        <div class="card-header">
            Дополнительная информация
        </div>
        <div class="card-body">
            @if($user->about == NULL)
                Дополнительной информации нет.
            @else
            {!! nl2br(e($user->about)) !!}
            @endif
        </div>
        <div class="card-header">
            Связь
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Мобильный телефон') }}</label>
                <div class="col-md-6">
                    {{$user->phone}}
                </div>
            </div>
            <div class="form-group row">
                <label for="e-mail" class="col-md-4 col-form-label text-md-right">{{ __('Электронная почта') }}</label>
                <div class="col-md-6">
                    {{$user->email}}
                </div>
            </div>
            @if($connect != NULL)
                @foreach ($connect as $item)
                    <span class="social-item"><a class="social" href="https://{{stristr($item->href, 'vk.com')}}"><img src="
                        @if(stristr($item->href, 'vk.com') == $item->href){{asset('docs/img/vk.png')}}
                        @elseif(stristr($item->href, 'facebook.com') == $item->href){{asset('docs/img/facebook.png')}}
                        @elseif(stristr($item->href, 'ok.ru') == $item->href || stristr($item->href, 'odnoklassniki.ru') == $item->href){{asset('docs/img/odno.png')}}
                        @elseif(stristr($item->href, 'telegram.org') == $item->href || stristr($item->href, 't.me') == $item->href){{asset('docs/img/telegram.png')}}
                        @else{{asset('docs/img/outpng.png')}}
                        @endif"></a></span>
                @endforeach
            @endif
        </div>
@if(isset($pass))
    
    <h5>Задолженности @if($student->gender == "м")ученика @else ученицы@endif:</h5>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Оценка</th>
            <th scope="col">Предмет</th>
            <th scope="col">Состояние</th>
            <th scope="col">Дата</th>
        </tr>
        </thead>
        <tbody>
        <?php $num=0 ?>
        @foreach ($pass as $item)
        <?php $num++ ?>
            <tr class="@if($item->tire==0) text-danger @elseif($item->tire==1) text-warning @else text-primary @endif">
                <th scope="row">{{$num}}</th>
                <td>{{$item->value}}</td>
                <td>{{$item->name}}</td>
                <td>@if($item->tire==0) Оповещен @elseif($item->tire==1) Ожидает проверки @else Закрыта @endif</td>
                <td>{{$item->date}}</td>
            </tr>      
        @endforeach
    </tbody>
    
</table>
    
@endif
</div>
@endsection