@extends('layouts.navbar')


@section('content')
<link rel="stylesheet" href="{{ asset('css/journ.css') }}">

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

    if(isset($_POST['journ_month'])){
        $month=$_POST['journ_month']-1;
        $dates = generateDates(new datetime('first day of '.$month.' month'), new datetime('last day of '.$month.' month'), [1,2,3,4,5]);
    }else{
        $dates = generateDates(new datetime('first day of this   month'), new datetime('last day of this  month'), [1,2,3,4,5]);
    }
    
    function findValue($date, $user, $data, $lesson) {
        
        foreach($data as $d) {
            if( $d->date != $date ) continue;
            if( $d->lesson_id != $lesson ) continue;
            return $d->value;
        }
        return ' ';
    }
    ?>






@endsection