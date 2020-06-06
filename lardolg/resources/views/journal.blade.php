
@extends('layouts.navbar')


@section('content')


<link rel="stylesheet" href="{{ asset('css/journ.css') }}">

@if(Auth::user()->typeAdmin !=1 )	
    <a class="typejourn" href=journal>Таблица по классам</a>
    
    <a class="typejourn" href=journal_object>Таблица по предметам</a>
@endif


@if(count($classes)==0) 
<h1 class="h1-high allert">У вас нет классов, которые вы ведете</h1>

@else
<h1 class="h1-high">Таблица по классам</h1>
    <form method="post" class="journ_month" id="MyForm">
        Месяц 
        {{csrf_field()}}
        <select name="journ_month" onchange="document.getElementById('MyForm').submit()">
        <option>Выбрать месяц</option>
        <option <?php if(isset($month)){if($month==='9'){echo"selected";}}elseif(date("m")==9){echo 'selected';}?> value="9">Сентябрь</option>
        <option <?php if(isset($month)){if($month==='10'){echo"selected";}}elseif(date("m")==10){echo 'selected';}?> value="10">Октябрь</option>
        <option <?php if(isset($month)){if($month==='11'){echo"selected";}}elseif(date("m")==11){echo 'selected';}?> value="11">Ноябрь</option>
        <option <?php if(isset($month)){if($month==='12'){echo"selected";}}elseif(date("m")==12){echo 'selected';}?> value="12">Декабрь</option>
        <option <?php if(isset($month)){if($month==='1'){echo"selected";}}elseif(date("m")==1){echo 'selected';}?> value="1">Январь</option>
        <option <?php if(isset($month)){if($month==='2'){echo"selected";}}elseif(date("m")==2){echo 'selected';}?> value="2">Февраль</option>
        <option <?php if(isset($month)){if($month==='3'){echo"selected";}}elseif(date("m")==3){echo 'selected';}?> value="3">Март</option>
        <option <?php if(isset($month)){if($month==='4'){echo"selected";}}elseif(date("m")==4){echo 'selected';}?> value="4">Апрель</option>
        <option <?php if(isset($month)){if($month==='5'){echo"selected";}}elseif(date("m")==5){echo 'selected';}?> value="5">Май</option>
        </select>
        </form>
        @endif
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

    @foreach ($classes as $class)
    <br>
    <h2>Классы: {{$class->number}}{{$class->type}}</h2>
        @foreach ($lessons[$class->id] as $lesson) 


        <div class="contain">

        <h2>Предмет: {{$lesson->name}}</h2>
        <table class="table">
        <thead>
        <tr>
            <th>ФИО</th>
            @foreach ($dates as $date)
                <th>{{$date->format("d.m")}}</th>
                
            @endforeach
        </tr>
        </thead>
        <tbody>            
            @foreach ($students as $student)
                @if($student->class_id==$class->id)
                    <tr>
                        <td><a href="{{ asset('users/'.$student->user_id)}}">{{$student->fio}}</a></td>
                        @foreach ($dates as $date) 
                        
                                <td
                                    data-user="{{$student->id}}"
                                    data-date="{{$date->format("Y-m-d")}}"
                                     class="editable <?php if(findValue($date->format("Y-m-d"), $student->id, $pass, $lesson->id)=='н' || findValue($date->format("Y-m-d"), $student->id, $pass, $lesson->id)=='2') echo 'red'; ?>">{{findValue($date->format("Y-m-d"), $student->id, $pass, $lesson->id)}}</td>
                        @endforeach
                    </tr>
                @endif
            @endforeach
            
        </tbody>
        </table>
        </div>
        @endforeach
    <br>
    
    @endforeach

@endsection
