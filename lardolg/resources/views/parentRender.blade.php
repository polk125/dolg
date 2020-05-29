@extends('layouts/navbar')
@section('content')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
<div class="profile"><div class="header"><h1>Профиль</h1>
    <h5>{{$user->name}}</h5>
    <h6>Роль: Родитель</h6>
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
@if(isset($children))
    
    <h5>Дети:</h5>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ФИО</th>
            <th scope="col">Класс</th>
            <th scope="col">Пол</th>
        </tr>
        </thead>
        <tbody>
        <?php $num=0 ?>
        @foreach ($children as $item)
        <?php $num++ ?>
            <tr>
                <th scope="row">{{$num}}</th>
                <td><a href="{{ asset('users/'.$item->user_id)}}">{{$item->fio}}</a></td>
                <td>{{$item->number}}{{$item->type}}</td>
                <td>{{$item->gender}}</td>
            </tr>      
        @endforeach
    </tbody>
    
</table>
    
@endif
</div>
@endsection