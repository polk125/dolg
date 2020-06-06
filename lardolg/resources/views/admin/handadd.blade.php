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
@if(session('errors'))
    @if(is_array($errors))
        @foreach ($errors as $error)
            {{$error}}
        @endforeach
    @else
    {{$errors}}
    @endif
    @endif
    @if(session('success'))
            {{session('success')}}
@endif
@isset($request)
<div class="container">
    <div class="card">
        <div class="card-header">
            Добавить пользователя вручную
        </div>
        <div class="card-body">
            @if($request->role == 2)
                <form id="addadminch" class="admin-test-form" enctype="multipart/form-data" action="{{url('/adminpanel/add/handteacher')}}" method="POST">
            @elseif($request->role == 3)
                <form id="addadminch" class="admin-test-form" enctype="multipart/form-data" action="{{url('/adminpanel/add/handstudent')}}" method="POST">
            @elseif($request->role == 4)
                <form id="addadminch" class="admin-test-form" enctype="multipart/form-data" action="{{url('/adminpanel/add/handparent')}}" method="POST">
            @endif
            
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ФИО*') }}</label>
    
                    <div class="col-md-6">
                    <input name="name" id="name" type="text" class="form-control" value="{{$request->name}}" required>
                        <span class="name-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="login" class="col-md-4 col-form-label text-md-right">{{ __('Логин*') }}</label>
    
                    <div class="col-md-6">
                        <input name="login" id="login" type="text" value="{{$request->login}}" class="form-control" required>
                        <span class="login-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('email') }}</label>
    
                    <div class="col-md-6">
                        <input name="email" id="email" type="email" @isset($request->email) value="{{$request->name}}"                             
                        @endisset class="form-control" placeholder="user@email.ru">
                        <span class="email-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Телефон') }}</label>
    
                    <div class="col-md-6">
                        <input name="phone" id="phone" type="tel" @isset($request->phone)value="{{$request->phone}}"
                            
                        @endisset class="form-control" maxlength="12" minlength="12" placeholder="+79152567689">
                        <span class="phone-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Роль*') }}</label>
    
                    <div class="col-md-6">
                        <select name="role" required>
                            @if($request->role == 1)<option  selected  value="1">Администратор</option>@endif
                            @if($request->role == 2)<option  selected  value="2">Учитель</option>@endif
                            @if($request->role == 3)<option  selected  value="3">Ученик</option>@endif
                            @if($request->role == 4)<option  selected  value="4">Родитель</option>@endif
                            </select><br>
                        <span class="role-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                @if($request->role == 3)
                <div class="form-group row">
                    <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Класс') }}</label>
    
                    <div class="col-md-6 class-input">
                        <input name="class_number" id="class-number" type="number" min="1" max="11" class="form-control" placeholder="5">
                        <input name="class_type" id="class-type" type="text" class="form-control" placeholder="а">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Parenth_fio" class="col-md-4 col-form-label text-md-right">{{ __('Фамилия родителя*') }}</label>
    
                    <div class="col-md-6">
                        <input name="Parenth_fio" id="Parenth_fio" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Parenth_login" class="col-md-4 col-form-label text-md-right">{{ __('Логин для родителя*') }}</label>
    
                    <div class="col-md-6">
                        <input name="Parenth_login" id="Parenth_login" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Parenth_login" class="col-md-4 col-form-label text-md-right">{{ __('Пол*') }}</label>
    
                    <div class="col-md-6">
                        <select id="class" name="gender" required>
                                <option value="м">М</option>
                                <option value="ж">ж</option>
                        </select><br>
                    </div>
                </div>
                @endif
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Добавить пользователя') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>   
@else
<div class="container">
    <div class="card">
        <div class="card-header">
            Добавить пользователя вручную
        </div>
        <div class="card-body">
            <form id="addadminch" class="admin-test-form" enctype="multipart/form-data" action="{{url('/adminpanel/add/handadd')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ФИО*') }}</label>
    
                    <div class="col-md-6">
                        <input name="name" id="name" type="text" class="form-control" required>
                        <span class="name-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="login" class="col-md-4 col-form-label text-md-right">{{ __('Логин*') }}</label>
    
                    <div class="col-md-6">
                        <input name="login" id="login" type="text" class="form-control" required>
                        <span class="login-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('email') }}</label>
    
                    <div class="col-md-6">
                        <input name="email" id="email" type="email" class="form-control" placeholder="user@email.ru">
                        <span class="email-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Телефон') }}</label>
    
                    <div class="col-md-6">
                        <input name="phone" id="phone" type="tel" class="form-control" maxlength="12" minlength="12" placeholder="+79152567689">
                        <span class="phone-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Роль*') }}</label>
    
                    <div class="col-md-6">
                        <select name="role" required>
                                <option value="1">Администратор</option>
                                <option value="2">Учитель</option>
                                <option value="3">Ученик</option>
                                <option value="4">Родитель</option>
                            </select><br>
                        <span class="role-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Добавить пользователя') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endisset


@endsection