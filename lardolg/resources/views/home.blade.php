@extends('layouts.navbar')

@section('content')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/modal.css')}}">
<link rel="stylesheet" href="{{ asset('css/home.css')}}">
<div class="profile">
    <div class="header">
        <h1>Профиль</h1>
        <h2>Вы авторизованы</h2>
        <h5> {{Auth::user()->name}}</h5>
    </div>
    <div class="content">
        <div class="card-header">
            Изменнение пароля
        </div>
        <div class="card-body">
            @if (\Session::has('success'))
                            <div class="alert alert-success">
                                    <li>Изменения сохранены
                            </div><br>
                        @endif
                        <form method="POST" action="reset">
                            @csrf


                            <div class="form-group row">
                                <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Старый пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="current_password" type="new_password" class="form-control @error('current_password') is-invalid @enderror" name="current_password"  required autocomplete="current_password" >

                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('Новый пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="new_password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new-new_password">

                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_password_confirm" class="col-md-4 col-form-label text-md-right">{{ __('Подтвердите пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="new_password_confirm" type="new_password" class="form-control" name="new_password_confirmation" required autocomplete="new-new_password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Изменить пароль') }}
                                    </button>
                                </div>
                            </div>
                        </form> 
                        
        </div>
    
    
        <div class="card-header">
            Дополнительная информация
        </div>
        <div class="card-body">
            <textarea class="form-control add-information"@if(Auth::user()->about == NULL) placeholder="Добавить дополнительную инфорамцию о себе...">@else>{{Auth::user()->about}}@endif</textarea>
        </div>
        <div class="card-header">
            Связь
        </div>
        <div class="card-body social-needs">
            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Мобильный телефон') }}</label>

                <div class="col-md-6">
                    <input id="phone" type="tel" class="form-control" value="@if(Auth::user()->phone == NULL)+7 @else{{Auth::user()->phone}}@endif" maxlength="12" minlength="12">
                    <span class="phone-feedback" role="alert">
                        <strong></strong>
                    </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="e-mail" class="col-md-4 col-form-label text-md-right">{{ __('Электронная почта') }}</label>

                <div class="col-md-6">
                    <input id="e-mail" type="email" class="form-control" value="@if(Auth::user()->email == NULL) @else{{Auth::user()->email}}@endif" placeholder="user@email.ru">
                    <span class="e-mail" role="alert">
                        <strong></strong>
                    </span>
                </div>
            </div>
        @if(count($includes)>0)
        <?php $num=0 ?>
            @foreach($includes as $include)
            <?php $num++ ?>
            
            <div id="social{{$num}}" class="form-group row social-group">
                <div class="deletebutton" data-id="{{$include->id}}" data-class="{{$num}}"></div>
                    <label for="socia{{$num}}" class="col-md-4 col-form-label text-md-right">{{ __('Другой способ связи') }}</label>
        
                    <div id="social{{$num}}" class="col-md-6 add">
                    <input id="social{{$num}}" data-id="{{$include->id}}" type="text" value="{{$include->href}}" class="form-control social-add" placeholder="vk.com/user">
                        <span class="social-feedback" role="alert">
                            <strong></strong>
                        </span>
                </div>
            </div>
            
            @endforeach
        @else
        <div id="social1" class="form-group row social-group">
            <label for="social" class="col-md-4 col-form-label text-md-right">{{ __('Другой способ связи') }}</label>

            <div id="social1" class="col-md-6 add">
                <input id="social1" type="text" data-id="" class="form-control social-add" placeholder="vk.com/user">
                <span class="social-feedback" role="alert">
                    <strong></strong>
                </span>
            </div>
        </div>
        @endif
        </div>
        <div class="addbutton">Добавить способ связи</div>
    @if(Auth::user()->typeAdmin==2)
        @if(isset($classes))
            <h5>Классный руководитель классов:</h5>
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Номер</th>
                    <th scope="col">Буква</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=0 ?>
                @foreach ($classes as $item)
                <?php $num++ ?>
                    <tr>
                        <th scope="row">{{$num}}</th>
                        <td>{{$item->number}}</td>
                        <td>{{$item->type}}</td>
                    </tr>      
                @endforeach
            </tbody>
            
        </table>
            
        @endif
        @if(count($lesson)>0)
            <h5>Преподователь в классах:</h5>
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Предмет</th>
                    <th scope="col">Класс</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=0 ?>
                @foreach ($lesson as $item)
                <?php $num++ ?>
                    <tr>
                        <th scope="row">{{$num}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->number}}{{$item->type}}</td>
                    </tr>      
                @endforeach
            </tbody>
            </table>

        @endif
    @elseif(Auth::user()->typeAdmin == 3)

    @endif
</div>
<script src="{{ asset('js/jquery.js')}}"></script>
<script src="{{ asset('js/home_edit.js')}}"></script>
@endsection
@section('modal')
<div class="modal">
        <div class="modal__alert">
            <h2 class="modal__title">Сохранение изменений</h2>
    </div>
</div>
@endsection