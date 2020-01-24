<h1>Задолжности</h1>
<?php
include("../db.php");
if(isset($_COOKIE['role'])) {
if($_COOKIE['role']==5) {
    $studid=$_COOKIE['user'];
    $result = mysqli_query($conn, "SELECT *,
    students.fio AS s_fio,
    pass.date AS p_date,
    pass.id AS p_id,
    pass.value AS p_value,
    pass.tire AS p_tire,
    pass.leasonid AS p_leasonid
    FROM students
    INNER JOIN pass ON students.id = pass.studid AND students.userid=$studid");
    while($row=mysqli_fetch_array($result)){
        if(mb_strtolower($row['p_value'])=='н'){
            $text='Отсутствие на уроке';
        }elseif($row['p_value']=='2'){
            $text='Оценка 2';
        }elseif($row['p_tire']==2){
            $resultsecond = mysqli_query($conn, "SELECT name FROM lesson WHERE id='$row[p_leasonid]'");
			$lesson_array = mysqli_fetch_assoc($resultsecond);
			$role = $lesson_array['name'];
            echo '<div class="alert blue">Вы успешно перездали предмет: '.$role.' на оценку: '.$row['p_value'].'</div>';
            continue;
        }else
        {
            continue;
        }
       
        $resultsecond = mysqli_query($conn, "SELECT name FROM lesson WHERE id='$row[p_leasonid]'");
				$lesson_array = mysqli_fetch_assoc($resultsecond);
				$role = $lesson_array['name'];
                echo '<div class="alert red"><h2>'.$role.'</h2>  У вас имееться задолжность по причине "'.$text.'"<br> От '.$row["date"].'</div>';
    }
    
} elseif($_COOKIE['role']==4){
    $result = mysqli_query($conn, "SELECT userid FROM students WHERE parenthid='$_COOKIE[user]' ");
							while($row=mysqli_fetch_array($result))
							{
                                $studid=$_COOKIE['user'];
                                $resultfirst = mysqli_query($conn, "SELECT *,
                                students.fio AS s_fio,
                                pass.date AS p_date,
                                pass.id AS p_id,
                                pass.value AS p_value,
                                pass.tire AS p_tire,
                                pass.leasonid AS p_leasonid
                                FROM students
                                INNER JOIN pass ON students.id = pass.studid AND students.userid='$row[userid]'");
                                while($rowfirst=mysqli_fetch_array($resultfirst)){
                                    if(mb_strtolower($rowfirst['p_value'])=='н'){
                                        $text='Отсутствие на уроке';
                                    }elseif($rowfirst['p_value']=='2'){
                                        $text='Оценка 2';
                                    }elseif($rowfirst['p_tire']==2){
                                        $resultsecond = mysqli_query($conn, "SELECT name FROM lesson WHERE id='$rowfirst[p_leasonid]'");
                                        $lesson_array = mysqli_fetch_assoc($resultsecond);
                                        $role = $lesson_array['name'];
                                        echo '<div class="alert blue">Ваш ребенок: '.$rowfirst['s_fio'].' успешно перездал предмет на оценку '.$role.' на оценку: '.$rowfirst['p_value'].'</div>';
                                        continue;
                                    }else
                                    {
                                        continue;
                                    }
                                    $resultsecond = mysqli_query($conn, "SELECT name FROM lesson WHERE id='$rowfirst[p_leasonid]'");
                                    $lesson_array = mysqli_fetch_assoc($resultsecond);
                                    $role = $lesson_array['name'];
                                    echo '<h2>'.$role.'</h2><div class="alert red"><div class="alert">У вашего ребенка: '.$rowfirst['s_fio'].' имееться задолжность по причине "'.$text.'"';
                                    echo ' </div>';
                                    
                                   
                                            echo 'От '.$rowfirst["p_date"];
        
                                            echo '<br><br></div>'; 
                            }
}
}elseif($_COOKIE['role']==3){
    echo'<h2>Задолжности по преподоваемому предмету</h2>';
//     $result = mysqli_query($conn, "SELECT lessonid, classid FROM lessonteacher WHERE teacherid='$_COOKIE[user]' ");
//     while($row=mysqli_fetch_array($result))
//     {
//         $resultfirst = mysqli_query($conn, "SELECT name FROM lesson WHERE id='$row[lessonid]'");
//         $lesson_array = mysqli_fetch_assoc($resultfirst);
//         $lesson = $lesson_array['name'];
//         $resultsecond = mysqli_query($conn, "SELECT number, type FROM class WHERE id='$row[classid]'");
//         $class_array = mysqli_fetch_assoc($resultsecond);
//         $class = $class_array['number'].$class_array['type'];
//         echo $lesson.'. Класс:  '.$class.'<br><br>';
        
// }
        $teacherid=$_COOKIE['user'];
        $result = mysqli_query($conn, "SELECT *,
        students.fio AS s_fio,
        pass.date AS p_date,
        pass.id AS p_id,
        pass.value AS p_value,
        pass.tire AS p_tire,
        pass.leasonid AS p_leasonid
        FROM pass
        INNER JOIN students ON pass.studid = students.id AND pass.teacherid=$teacherid");
        while($rowsecond=mysqli_fetch_array($result)){
            if(mb_strtolower($rowsecond['p_value'])=='н'){
                $text='Отсутствие на уроке';
            }elseif($rowsecond['p_value']=='2'){
                $text='Оценка 2';
            }elseif($rowsecond['p_tire']==2){
                $resultfirst = mysqli_query($conn, "SELECT name FROM lesson WHERE id='$rowfirst[p_leasonid]'");
                $lesson_array = mysqli_fetch_assoc($resultfirst);
                $role = $lesson_array['name'];
                echo '<div class="alert blue">Ваш ученик: '.$rowfirst['s_fio'].' прислал вам работу на проверку </div>'.$role;
                continue;
            }else
            {
                continue;
            }
            echo '<div class="alert"><div class="alert"><br>Задолжность ученика '.$rowsecond[s_fio];
            echo '</div>';
            echo '<div> От '.$rowsecond["p_date"].'</div>';
            $resultfour = mysqli_query($conn, "SELECT name FROM lesson WHERE id='$rowsecond[p_leasonid]'");
                    $lesson_array = mysqli_fetch_assoc($resultfour);
                    $role = $lesson_array['name'];
                    echo 'Задолжность по предмету: '.$role;
                    echo '<br></div>'; 
}
$result = mysqli_query($conn, "SELECT * FROM class WHERE teacherid='$_COOKIE[user]'");

if(null !==mysqli_fetch_array($result)){
    $result = mysqli_query($conn, "SELECT * FROM class WHERE teacherid='$_COOKIE[user]'");
    echo'<br><h2>Задолжности по классам</h2>';
    while($row=mysqli_fetch_array($result)){
        echo '<h3>Класс: '.$row[number].$row[type].'</h3>';
        $resultsecond = mysqli_query($conn, "SELECT *,
        students.fio AS s_fio,
        pass.date AS p_date,
        pass.id AS p_id,
        pass.leasonid AS p_leasonid
        FROM pass
        INNER JOIN students ON pass.studid = students.id AND students.classid='$row[id]'");
        if(null ==mysqli_fetch_array($resultsecond)){
            echo '<br>Задолжностей нет<br><br>';
        }else{
        $resultsecond = mysqli_query($conn, "SELECT *,
        students.fio AS s_fio,
        pass.date AS p_date,
        pass.id AS p_id,
        pass.leasonid AS p_leasonid
        FROM pass
        INNER JOIN students ON pass.studid = students.id AND students.classid='$row[id]'");
        while($rowsecond=mysqli_fetch_array($resultsecond)){
            echo '<div class="alert"><div class="alert"><br>Задолжность ученика '.$rowsecond[s_fio];
            echo ' </div>';
            echo '<div> От '.$rowsecond["p_date"].'</div>';
            $resultfour = mysqli_query($conn, "SELECT name FROM lesson WHERE id='$rowsecond[p_leasonid]'");
                    $lesson_array = mysqli_fetch_assoc($resultfour);
                    $role = $lesson_array['name'];
                    echo 'Задолжность по предмету: '.$role;
                    echo '<br><br></div>'; 
        }
    }
}
}
}
}
?>