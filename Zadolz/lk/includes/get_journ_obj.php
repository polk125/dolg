<script src="js/get_attendance.js"></script>
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
    
    function findValue($date, $user, $data) {
        
        foreach($data as $d) {
            if( $d['date'] != $date ) continue;
            return $d['value'];
        }
        return ' ';
    }
$conn = new PDO(
    "mysql:host=localhost;dbname=zadolz;charset=utf8",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);


$results = $conn->query("SELECT * FROM pass")->fetchAll();
$objs= $conn->query("SELECT * FROM lessonteacher WHERE teacherid='$_COOKIE[user]'")->fetchAll();

foreach ($objs as $obj): 
   $objName= $conn->query("SELECT name FROM lesson WHERE id='$obj[lessonid]'")->fetch();
   $class= $conn->query("SELECT * FROM class WHERE id='$obj[classid]'")->fetch();
    ?>
<br>
<div class="container">

<h2>Предмет: <?=$objName['name']?></h2>

<h2>Класс: <?=$class['number']?><?=$class['type']?></h2>
<table class="table">
    <thead>
    <tr>
        <th>ФИО</th>
        <?php foreach ($dates as $date): ?>
            <th><?=$date->format("d.m")?></th>
            
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    
        <?php
        $users = $conn->query("SELECT * FROM students WHERE classid='$class[id]' ORDER BY fio ")->fetchAll();
        foreach ($users as $user):
        $results = $conn->query("SELECT * FROM pass WHERE leasonid='$obj[lessonid]' AND studid='$user[id]'")->fetchAll();
        ?>
            <tr>
                <td><?=$user['fio']?></td>
                <?php foreach ($dates as $date): ?>
                        <td
                            data-user="<?=$user['id']?>"
                            data-date="<?=$date->format("Y-m-d")?>"
                            data-obj="<?=$obj['id']?>"
                            class="editable <?php if(findValue($date->format("Y-m-d"), $user['id'], $results)=='н' || findValue($date->format("Y-m-d"), $user['id'], $results)=='2') echo 'red'; ?>"><?=findValue($date->format("Y-m-d"), $user['id'], $results)?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php endforeach; ?>
<script src="script.js"></script>
</body>
</html>

 