@extends('layouts/navbar')
@section('content')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/admin.css')}}">
<link rel="stylesheet" href="{{ asset('css/modal.css')}}">
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
<div class="container">
    <div class="card-header">
        Класс
    </div>
    <div class="card-body">

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">{{ __('Класс') }}</label>

            <div class="col-md-6">
                <h5>{{$classes->number}}{{$classes->type}}</h5>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">{{ __('Классный руководитель') }}</label>

            <div class="col-md-6">
                <select data-id="{{$classes->id}}" id="teacher" name="teacher" required>
                    <option value="">-- Классный руководитель --</option>
                    @foreach ($teachers as $teacher)
                        <option   @if($classes->teacher_id == $teacher->id ) selected @endif  value="{{$teacher->id}}">{{$teacher->name}}</option>
                    @endforeach
                    </select><br>
            </div>
        </div>
       
    </div>
    <div class="card-header">
        Ученики
    </div>
    <div class="card-body">
        <table class="table">
        <thead class="thead-light">
            <tr> 
            <th scope="col">#</th>
              <th scope="col">Ученик</th>
              <th scope="col">Пол</th>
              <th scope="col">Родитель</th>
            </tr>
          </thead>
          <tbody>
            <?php $num=0?>
          @foreach($students as $student)
          <?php $num++?>
            <tr>
            <td>{{$num}}</td>
            <td><a href="{{ asset('adminpanel/classes/'.$student->id)}}">{{$student->fio}}</a></td>
            <td>{{$student->gender}}</td>
            <td><a href="{{ asset('adminpanel/users/'.$student->parenth_id)}}">{{$student->name}}</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
    <div class="card-header">
        Предметы
    </div>
    <div class="card-body">
        <table class="table">
        <thead class="thead-light">
            <tr> 
            <th scope="col">#</th>
              <th scope="col">Предмет</th>
              <th scope="col">Преподователь</th>
              <th scope="col">Удалить</th>
            </tr>
          </thead>
          <tbody id="lessonteacher">
            <?php $num=0?>
          @foreach($lessonteachers as $lessonteacher)
          <?php $num++?>
            <tr data-num="{{$num}}">
            <td>{{$num}}</td>
            <td>{{$lessonteacher->name}}</td>
            <td>
                <select data-set="{{$lessonteacher->id}}" name="lessonteacher" id="addlessonteacher">
                    <option value="">-- Учитель предметник --</option>
                    @foreach($teachers as $teacher)
                        <option   @if($teacher->id == $lessonteacher->teacher_id ) selected @endif  value="{{$teacher->id}}">{{$teacher->name}}</option>
                    @endforeach
                </select>
            </td>
            <td><button
                data-id="{{$lessonteacher->id}}"
                id="save" title="Закрыть задолжность" type="button" class="close" >&times;</button >
            </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <select data-set="{{$classes->id}}" name="addlesson" id="addlesson">
            <option value="">-- Добавить предмет --</option>
            @foreach($lessons as $lesson)
                <option value="{{$lesson->id}}">{{$lesson->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<script src="{{ asset('js/edit_class.js')}}"></script>
@endsection
@section('modal')
    <div class="modal">
            <div class="modal__alert">
                <h2 class="modal__title">Сохранение изменений</h2>
        </div>
    </div>
@endsection