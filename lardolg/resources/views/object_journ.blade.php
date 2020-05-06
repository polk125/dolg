@extends('layouts.navbar')


@section('content')
<link rel="stylesheet" href="{{ asset('css/journ.css') }}">
@if(!isset($lessons))
<a class="typejourn" href=journal>Таблица по классам</a>
    
<a class="typejourn" href=journal_object>Таблица по предметам</a>
<h1>У вас нет предметов, которовые вы ведете</h1>
@else
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.1/jquery.min.js"></script>
<script src="js/get_attendance.js"></script>
    <a class="typejourn" href=journal>Таблица по классам</a>
    
    <a class="typejourn" href=journal_object>Таблица по предметам</a>
    <form method="post" class="journ_month" id="MyForm">
        Месяц 
        {{csrf_field()}}
        <select name="journ_month" onchange="document.getElementById('MyForm').submit()">
        <option <?php if(isset($month)){if($month==='9'){echo"selected";}}elseif(date("m")==9){echo 'selected';}?> value="9">Сентябрь</option>
        <option <?php if(isset($month)){if($month==='10'){echo"selected";}}elseif(date("m")==10){echo 'selected';}?> value="10">Октябрь</option>
        <option <?php if(isset($month)){if($month==='11'){echo"selected";}}elseif(date("m")==11){echo 'selected';}?> value="11">Ноябрь</option>
        <option <?php if(isset($month)){if($month==='12'){echo"selected";}}elseif(date("m")==12){echo 'selected';}?> value="12">Декабрь</option>
        <option <?php if(isset($month)){if($month==='1'){echo"selected";}}elseif(date("m")==1){echo 'selected';}?> value="1">Январь</option>
        <option <?php if(isset($month)){if($month==='2'){echo"selected class=selected";}}elseif(date("m")==2){echo 'selected';}?> value="2">Февраль</option>
        <option <?php if(isset($month)){if($month==='3'){echo"selected";}}elseif(date("m")==3){echo 'selected';}?> value="3">Март</option>
        <option <?php if(isset($month)){if($month==='4'){echo"selected";}}elseif(date("m")==4){echo 'selected';}?> value="4">Апрель</option>
        <option <?php if(isset($month)){if($month==='5'){echo"selected";}}elseif(date("m")==5){echo 'selected';}?> value="5">Май</option>
        </select>
        </form>

<?php 
    function generateDates($start, $end, $weekDays) {
        $interval = DateInterval::createFromDateString('1 day');
        $period   = new DatePeriod($start, $interval, $end);
        $dates = [];
        foreach ($period as $date) {
            if (in_array($date->format("N"), $weekDays)) {
                $dates[] = $date;
            }
        }
        return $dates;
    }
    function firstDay($date){
        $date = explode('-',$date);
        return new DateTime("date[0]-$date[1]-01");
        }
         
        function lastDay($date){
        $day = date('t',$date);
        $date = explode('-',$date);
        return new DateTime("$date[0]-$date[1]-$day");
        }   
    if(isset($month)){
        $month=$month-date('m');
        $dates = generateDates(new datetime('first day of '.$month.' month'), new datetime('last day of '.$month.' month'), [1,2,3,4,5]);
    }else{
        $dates = generateDates(new datetime('first day of this   month'), new datetime('last day of this  month'), [1,2,3,4,5]);
    }
    
    function findValue($date, $user, $data, $lesson) {
        
        foreach($data as $d) {
            if( $d->date != $date ) continue;
            if( $d->lesson_id != $lesson ) continue;
            if( $d->student_id != $user ) continue;
            return $d->value;
        }
        return ' ';
    }
    ?>


@foreach ($lessons as $lesson)
<br>
<div class="container">
    @foreach($names[$lesson->id] as $name)
    <h2>Предмет: {{$name->name}}</h2>
    @endforeach
    @foreach($classes[$lesson->id] as $class)
    <h2>Класс: {{$class->number}}{{$class->type}}</h2>
    @endforeach

    <table class="table">
        <thead>
        <tr>
            <th>ФИО</th>
            @foreach ($dates as $date)
                <th><?=$date->format("d.m")?></th>
                
            @endforeach
        </tr>
        </thead>
        <tbody>
        
            @foreach($students[$lesson->id] as $student)

                <tr>
                    <td>{{$student->fio}}</td>  
                    @foreach ($dates as $date)
                        <td
                        data-user="{{$student->id}}"
                        data-date="{{$date->format("Y-m-d")}}"
                        class="editable <?php if(findValue($date->format("Y-m-d"), $student->id, $pass, $lesson->id)=='н' || findValue($date->format("Y-m-d"), $student->id, $pass, $lesson->id)=='2') echo 'red'; ?>">{{findValue($date->format("Y-m-d"), $student->id, $pass, $lesson->id)}}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

</div>


@endforeach
<link rel="stylesheet" href="css/stile.css">
<script src="js/jquery.js"></script>
<div class="modal">
        <div class="modal__overlay"></div>
        <div class="modal__window">
            <h2 class="modal__title">Заголовок</h2>
            <form name="modal_form" class="modal__text" method="post">
					<div class="form-group">
						<div class="input-group-my modal-input">
                        <label>Оценка</label>
							<input type="text" name="modal_dolg" class="form-control modalInput" value="н">
						</div>
                    </div>
                    <label for="check">С возможностью исправить</label>
                    <input id="check" type="checkbox" checked="checked" onclick="if(this.checked){document.querySelector('.hiden').style.display=''}else {document.querySelector('.hiden').style.display='none';  document.querySelector('.form-control-bottom').value='';}">
					<div class="form-group hiden">
					<label>Тест для исправления </label><div class="main__content">
					</div>
					</div>
					<div class="form-group why">
						<div class="input-group-my">
							<label>Причина </label>
							<textarea type="text" name="modal_why" class="form-control form-control-bottom" placeholder="Можно пропустить"></textarea>
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
@endif
@endsection