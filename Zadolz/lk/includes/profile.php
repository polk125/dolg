

<?php   
if ($_COOKIE['role'] == 1) {
    
    echo '<div class="profile"><button id="addadmin" class="admin-add-btn admin-btn">Добавить администратора</button><br><br>';
    echo '
    <form id="addadminch" hidden class="admin-add-form" enctype="multipart/form-data" action="includes/addAdmin.php" method="POST">
    <label for="name">Имя</label>
    <input type="text" name="name" id="login" required><br><br>
    <label for="surname">Фамилия</label>
    <input type="text" name="surname" id="login" required><br><br>
    <label for="patronomic">Отчество</label>
    <input type="text" name="patronomic" id="login" required><br><br>
    <label for="login">Логин</label>
    <input type="text" name="login" id="login" required><br><br>
    <label for="password">Пароль</label>
    <input type="password" name="password" id="password" required><br><br>
    <lavel for="role">Роль</label>
    <select name="role">
                <option value="1">Администратор</option>
                <option value="2">Директор</option>
                <option value="3">Учитель</option>
                <option value="4">Родитель</option>
                <option value="5">Ученик</option>
				</select>
    <br><br><input class="admin-btn" type="submit" value="Добавить">
    </form></div>';
}

 if($_COOKIE[role]!=1){
    $name=$_COOKIE[user];
    $select_sql = "SELECT * FROM users WHERE id='$name'";
 } else {
    $select_sql = "SELECT * FROM users ORDER BY id ASC";
    
}
$result = mysqli_query($conn, $select_sql);
while ($row = mysqli_fetch_assoc($result)) {
   echo '<div class="profile"><h1>Профиль</h1>
 <h2>ФИО</h2>';
    echo '<div class="admin-div">';
    echo '<h2>'.$row['name'].' '.$row['surname'].'</h2>';
    if ($_COOKIE['role'] == 1) {
    if($row['role']==1){
    echo '<br>Роль: Администратор<br>';
    }elseif($row['role']==2){echo '<br>Роль: Директор<br>';}elseif($row['role']==3){echo '<br>Роль: Учитель<br>';}elseif($row['role']==4){echo '<br>Роль: Родитель<br>';}elseif($row['role']==5){echo '<br>Роль: Ученик<br>';}
    }
    if ($row['id'] == $_COOKIE[user]) {
        echo '<span class="admin-row admin-active">'.$row['login'].'</span>';
    } else {
        echo '<span class="admin-row">'.$row['login'].'</span>';
    }
    if ($row['id'] !== $_COOKIE[user]) {
        echo '<a href="includes/deleteAdmin.php?id=';
        echo $row['id'];
        echo '" class="admin-del-btn"> Удалить пользователя</a>';
    }
    if ($row['id'] == $_COOKIE[user]) {
        echo '<br><br>';
        echo '<button id="admin" class="admin-ch-btn admin-btn">Изменить пароль</button>';
        echo '
        <form hidden id="adminch" class="admin-ch-form" action="includes/editPassword.php" method="POST">
        <label for="login">Введите текущий пароль</label>
        <input type="password" name="opassword" id="opassword" required><br><br>
        <label for="login">Введите новый пароль</label>
        <input type="password" name="npassword" id="pnassword" required><br><br>
        <input type="hidden" name="id" value='.$row['id'].'>';
        echo '<input class="admin-cha-btn admin-btn" type="submit" value="Изменить">';
        echo '</form>';
    }
    echo '</div>';
    if($_COOKIE['role']==3){
        
        $resultthree = mysqli_query($conn, "SELECT *,
        lesson.name AS lesson_name,
        lessonteacher.classid AS class_id
        FROM lesson
        INNER JOIN lessonteacher ON lessonteacher.lessonid = lesson.id AND lessonteacher.teacherid='$_COOKIE[user]' ");
        while($rowsecond=mysqli_fetch_array($resultthree)){
            echo '<div class="alert"><div class="alert"><br>Закреплен за предметами "'.$rowsecond[lesson_name].'"';
            $resultfour = mysqli_query($conn, "SELECT * FROM class WHERE id='$rowsecond[class_id]'");
                    $lesson_array = mysqli_fetch_assoc($resultfour);
                    $role = $lesson_array['number'].$lesson_array['type'];
                    echo ' Класса: '.$role;
}
$resultsecond = mysqli_query($conn, "SELECT * FROM class WHERE teacherid='$_COOKIE[user]'");
while($class_array = mysqli_fetch_assoc($resultsecond)){
echo '<br><br>Классный руководитель класса: '.$class_array[number].$class_array[type].'<br><br>';
}
}elseif($_COOKIE['role']==5){
    $resultsecond = mysqli_query($conn, "SELECT * FROM students WHERE userid='$_COOKIE[user]'");
        $rowsecond=mysqli_fetch_array($resultsecond);
    $resultfirst= mysqli_query($conn, "SELECT * FROM class WHERE id='$rowsecond[classid]'");
    $rowfirst=mysqli_fetch_array($resultfirst);
    echo 'Ученик класса: '.$rowfirst['number'].' '.$rowfirst['type'].'</div>';
}
echo '</div>';
}

?>

