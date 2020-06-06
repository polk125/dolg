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
<div class="row align-items-center">
    <div class="col">
    <a href="{{ asset('adminpanel/handadd') }}">
        Добавить пользователя вручную
    </a>
    </div>
</div>

<div class="container">
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
    <div class="card">
        <div class="card-header">
            Добавить учеников
        </div>
        <div class="card-body">
        <form action="{{url('/adminpanel/add/uploadstudent')}}" method="post" enctype="multipart/form-data">
        @csrf
            Выберите файл для добавления Учеников
            <br><br>
            <input type="file" id="file" name="file"><br><br>
            <button type="submit" class="addbutton">Загрузить пользователей</button>

        </form>
        </div>
        <div class="card-header">
            Шаблон для учеников
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ФИО*</th>
                        <th scope="col">Email</th>
                        <th scope="col">Логин*</th>
                        <th scope="col">Телефон</th>
                        <th scope="col">Пол*</th>
                        <th scope="col">Номер класса</th>
                        <th scope="col">Цифра класса</th>
                        <th scope="col">ФИО родителя*</th>
                        <th scope="col">Логин родителя*</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">Иванов Иван Михайлович</th>
                            <th scope="col">ivan@gmail.com</th>
                            <th scope="col">ivan</th>
                            <th scope="col">89862455498</th>
                            <th scope="col">М</th>
                            <th scope="col">1</th>
                            <th scope="col">б</th>
                            <th scope="col">Иванов Михаил Алексеевич</th>
                            <th scope="col">mihail</th>
                        </tr>
                        <tr>
                            <th scope="col">Иванова Марина Альбертовна</th>
                            <th scope="col"></th>
                            <th scope="col">Marina</th>
                            <th scope="col"></th>
                            <th scope="col">Ж</th>
                            <th scope="col">2</th>
                            <th scope="col">а</th>
                            <th scope="col">Иванов Альберт Александрович</th>
                            <th scope="col">albert</th>
                        </tr>
                    </tbody>
            </table>
        </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                Добавить учителей
            </div>
        <div class="card-body">
            <form action="{{url('/adminpanel/add/uploadteacher')}}" method="post" enctype="multipart/form-data">
            @csrf
                Выберите файл для добавления Учителей
                <br><br>
                <input type="file" id="file" name="file"><br><br>
                <button type="submit" class="addbutton">Загрузить пользователей</button>

            </form>
        </div>
        <div class="card-header">
            Шаблон для учителей
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ФИО*</th>
                        <th scope="col">Email</th>
                        <th scope="col">Логин*</th>
                        <th scope="col">Телефон</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">Иванов Иван Михайлович</th>
                            <th scope="col">ivan@gmail.com</th>
                            <th scope="col">ivan</th>                            
                            <th scope="col">89862455498</th>
                        </tr>
                        <tr>
                            <th scope="col">Иванова Марина Альбертовна</th>
                            <th scope="col"></th>                            
                            <th scope="col">Marina</th>        
                            <th scope="col"></th>
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>
    
</div>
@endsection