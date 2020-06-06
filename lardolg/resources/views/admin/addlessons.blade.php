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
    {{session('errors')}}
    @endif
    @endif
    @if(session('success'))
            {{session('success')}}
    @endif
<div class="container">
    <div class="card">
        <div class="card-header">
            Добавить предмет
        </div>
        <div class="card-body">
            <form id="addadminch" class="admin-test-form" enctype="multipart/form-data" action="{{url('adminpanel/add/lesson')}}" method="POST">

            
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Название предмета*') }}</label>

                <div class="col-md-6">
                <input name="name" id="name" type="text" class="form-control" required>
                    <span class="name-feedback" role="alert">
                        <strong></strong>
                    </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Классы в которых проводится*') }}</label>

                <div class="col-md-6 class-input">
                   С <input name="start" id="class-number" type="number" min="1" max="11"  class="form-control" placeholder="5">
                   ПО <input name="end" id="class-type" type="number" min="1" max="11" class="form-control" placeholder="5">
                    <span class="name-feedback" role="alert">
                        <strong></strong>
                    </span>
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Добавить предмет') }}
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
@section('modal')
    <div class="modal">
            <div class="modal__alert">
                <h2 class="modal__title">Сохранение изменений</h2>
        </div>
    </div>
@endsection