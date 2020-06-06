@extends('layouts/navbar')
@section('content')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/additional.css')}}">
<div class="navigate">
<a class="typejourn" href="{{ asset('makeadditional')}}">Создать дополнительное занятие</a>
<a class="typejourn" href="{{ asset('additional')}}">Назад</a>
</div>
<div class="container">
    
    <div class="card">
        <form id="addadminch" class="admin-test-form" enctype="multipart/form-data" action="add_additional" method="POST">
        <div class="card-header">

            <div class="form-group row">
                <label for="theme" class="col-md-4 col-form-label text-md-right">{{ __('Тема урока*') }}</label>

                <div class="col-md-6">
                    <input id="theme" type="text" class="form-control"  name="theme"  required autocomplete="current_password">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="about" class="col-md-4 col-form-label text-md-right">{{ __('Подробнее') }}</label>

                <div class="col-md-6">
                    <textarea class="form-control add-information" name="about" placeholder="Добавить дополнительную инфорамцию..." autocomplete="theme"></textarea>                   
                </div>
            </div>
            <div class="form-group row">
                <label for="lesson" class="col-md-4 col-form-label text-md-right">{{ __('Предмет*') }}</label>

                <div class="col-md-6">
                    <select name="lesson">
                        @foreach($objs as $obj)
                            <option value="{{$obj->id}}">{{$obj->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Год обучения*') }}</label>

                <div class="col-md-6">
                    <input id="class" type="number" min="1" max="11" class="form-control" name="class"  required autocomplete="lesson" placeholder="5" >
                </div>
            </div>
            <div class="form-group row">
                <label for="maxstudents" class="col-md-4 col-form-label text-md-right">{{ __('Максимум учеников*') }}</label>

                <div class="col-md-6">
                    <input id="maxstudents" type="number" min="1" class="form-control" name="maxstudents"  required autocomplete="class" placeholder="15" >
                </div>
            </div>
            <div class="form-group row">
                <label for="longhour" class="col-md-4 col-form-label text-md-right">{{ __('Продолжительность') }}</label>

                <div class="col-md-6">
                    <input id="longhour" type="number" min="0" max="24" class="form-control" name="longhour"  autocomplete="maxstudents" placeholder="0" >
                    <input id="longmin" type="number" min="0" max="59" class="form-control" name="longmin"  required autocomplete="longhour" placeholder="45" >
                </div>
            </div>
            <div class="form-group row">
                <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Время проведения*') }}</label>

                <div class="col-md-6">
                    <input id="time" type="time" class="form-control" name="time"  required autocomplete="longhour"  >
                </div>
            </div>
            <div class="form-group row">
                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Дата проведения*') }}</label>

                <div class="col-md-6">
                    <input id="date" type="date" class="form-control" name="date"  required autocomplete="time"  >
                </div>
            </div>
            <div class="form-group row">
            <p class="col-md-4 col-form-label text-md-right">* - обязательные поля</p>
            <div class="col-md-6">
                <input class="admin-btn" type="submit" value="Создать">
            </div>
        </div>
            {{csrf_field()}}
         
        </div>
    </form> 
    </div> 
</div>
@endsection