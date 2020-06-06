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
        Профиль
    </div>
    <div class="card-body">

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">{{ __('ФИО') }}</label>

            <div class="col-md-6">
                <h5>{{$users->name}}</h5>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">{{ __('Роль') }}</label>

            <div class="col-md-6">
                <h5> @if($users->typeAdmin == 1)Администратор@elseif($users->typeAdmin == 2)Учитель@elseif($users->typeAdmin == 3)Ученик@elseif($users->typeAdmin == 4)Родитель@endif</h5>
            </div>
        </div>
       
    </div>
    
    <div class="card-header">
        Изменнение пароля
    </div>
    <div class="card-body">
        @if (\Session::has('success'))
                        <div class="alert alert-success">
                                <li>Изменения сохранены
                        </div><br>
                    @endif
                    <div class="form-group row mb-0" >
                        <div class="col-md-6 offset-md-4" >
                            <div id="new-password" @if(session('password')) style="visibility: visible" @endif>@if(session('password'))
                                Пароль пользователя: {{session('password')}}@if(session('passwordparent'))<br/>Пароль родителя: {{session('passwordparent')}}@endif
                            @endisset</div>
                        </div>
                    </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button data-id="{{$users->id}}" id="submit" class="btn btn-primary new-password">
                                    {{ __('Сгенерировать новый пароль') }}
                                </button>
                            </div>
                        </div>
    </div>


    <div class="card-header">
        Дополнительная информация
    </div>
    <div class="card-body">
        <textarea data-id="{{$users->id}}" class="form-control add-information"@if($users->about == NULL) placeholder="Добавить дополнительную инфорамцию о себе...">@else>{{$users->about}}@endif</textarea>
    </div>
    <div class="card-header">
        Связь
    </div>
    <div class="card-body social-needs">
        <div class="form-group row">
            <label  for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Мобильный телефон') }}</label>

            <div class="col-md-6">
                <input data-id="{{$users->id}}" id="phone" type="tel" class="form-control" value="@if($users->phone == NULL)+7 @else{{$users->phone}}@endif" maxlength="12" minlength="12">
                <span class="phone-feedback" role="alert">
                    <strong></strong>
                </span>
            </div>
        </div>
        <div class="form-group row">
            <label for="e-mail" class="col-md-4 col-form-label text-md-right">{{ __('Электронная почта') }}</label>

            <div class="col-md-6">
            <input data-id="{{$users->id}}" id="e-mail" type="email" class="form-control" value="@if($users->email == NULL) @else{{$users->email}}@endif" placeholder="user@email.ru">
                <span class="e-mail" role="alert">
                    <strong></strong>
                </span>
            </div>
        </div>
    </div>
    @if($users->typeAdmin==3)
    <div class="card-header">
        Информация об ученике
    </div>
    <div class="card-body social-needs">
        <div class="form-group row">
            <label  for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Класс') }}</label>

            <div class="col-md-6">
                <select data-id="{{$users->id}}" id="class" name="class" required>
                    <option value="">-- Класс обучения --</option>
                    @foreach ($classes as $class)
                        <option   @if($class->id == $student->class_id ) selected @endif  value="{{$class->id}}">{{$class->number}}{{$class->type}}</option>
                    @endforeach
                    </select><br>
            </div>
        </div>
        <div class="form-group row">
            <label  for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Родитель') }}</label>

            <div class="col-md-6">
                <select data-id="{{$users->id}}" id="parent" name="parent" required>
                    <option value="">--Родитель ученика--</option>
                    @foreach ($parenth as $parent)
                        <option   @if($parent->id == $student->parenth_id ) selected @endif  value="{{$parent->id}}">{{$parent->name}}</option>
                    @endforeach
                    </select><br>
                </span>
            </div>
        </div>
    </div>
    @if(count($pass)>0)
    
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
    <script src="{{ asset('js/student_edit.js')}}"></script>
    @elseif($users->typeAdmin==2)
    <div class="card-header">
        Классы, которые ведет данный учитель
    </div>
    <div class="card-body">
    @if(count($classes) <= 0)
        <span>Отсутствуют</span>
    @else
    <table class="table">
  
        <thead class="thead-light">
          <tr> 
          <th scope="col">#</th>
            <th scope="col">Класс</th>
            <th scope="col">Снять роль</th>
          </tr>
        </thead>
        <tbody>
          <?php $num=0?>
        @foreach($classes as $classe)
        <?php $num++?>
          <tr>
          <td>{{$num}}</td>
          <td><a href="{{ asset('adminpanel/classes/'.$classe->id)}}">{{$classe->number}}{{$classe->type}}</a></td>
          <td><button
            data-id="{{$classe->id}}"
            id="save" title="Снять роль" type="button" class="close" >&times;</button ></td>
          </tr>
        </tr>
        @endforeach
        </tbody>
        </table>
    @endif
    </div>
    <div class="card-header">
        Предметы, который ведет учитель
    </div>
    <div class="card-body">
    @if(count($lessonteacher) <= 0)
        <span>Отсутствуют</span>
    @else
    <table class="table">
  
        <thead class="thead-light">
          <tr> 
          <th scope="col">#</th>
            <th scope="col">Класс</th>
            <th scope="col">Предмет</th>
            <th scope="col">Убрать роль</th>
          </tr>
        </thead>
        <tbody>
          <?php $num=0?>
        @foreach($lessonteacher as $lessonteachers)
        <?php $num++?>
          <tr>
          <td>{{$num}}</td>
          <td><a href="{{ asset('adminpanel/classes/'.$lessonteachers->cid)}}">{{$lessonteachers->number}}{{$lessonteachers->type}}</a></td>
          <td>{{$lessonteachers->name}}</td>
          <td><button
            data-id="{{$lessonteachers->id}}"
            id="save" title="Снять роль" type="button" class="closelesson" >&times;</button ></td>
          </tr>
        </tr>
        @endforeach
        </tbody>
        </table>
    @endif
    </div>
        <script src="{{ asset('js/teacher.js')}}"></script>
    @elseif($users->typeAdmin==4)
        <div class="card-header">
            Дети
        </div>
        <div class="card-body">
        @if(count($children) <= 0)
            <span>Отсутствуют</span>
        @else
        <table class="table">
  
            <thead class="thead-light">
              <tr> 
              <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Класс</th>
                <th scope="col">Убрать роль</th>
              </tr>
            </thead>
            <tbody>
              <?php $num=0?>
            @foreach($children as $childrens)
            <?php $num++?>
              <tr>
              <td>{{$num}}</td>
              <td><a href="{{ asset('adminpanel/classes/'.$childrens->cid)}}">{{$childrens->number}}{{$childrens->type}}</a></td>
              <td><a href="{{ asset('adminpanel/users/'.$childrens->uid)}}">{{$childrens->name}}</a></td>
              <td><button
                data-id="{{$childrens->id}}"
                id="save" title="Снять роль" type="button" class="close" >&times;</button ></td>
              </tr>
            </tr>
            @endforeach
            </tbody>
            </table>
        @endif
        </div>
        <script src="{{ asset('js/parenth.js')}}"></script>
    @endif
</div>
<script src="{{ asset('js/user_edit.js')}}"></script>
@endsection
@section('modal')
    <div class="modal">
            <div class="modal__alert">
                <h2 class="modal__title">Сохранение изменений</h2>
        </div>
    </div>
@endsection