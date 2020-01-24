<?php
    session_start();
    if (!isset($_COOKIE['user'])) {
        header('Location: ../auth.php');
    } 
    include('../db.php');
    $password = mysqli_fetch_array(mysqli_query($conn, "SELECT password FROM users WHERE id = '".$_POST['id']."'"))['password'];
    if(md5($_POST['opassword'])==$password){
        

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }

    if (isset($_POST['npassword'])) {
        $npassword = md5($_POST['npassword']);
    }

    $update_sql = "UPDATE users SET password = '$npassword' WHERE id = '$id'";
    if (mysqli_query($conn, $update_sql)) {
        echo 'Пароль успешно изменен.';
    } else {
        echo 'Ошибка запроса.';
    }
    }
    $conn->close();
    header('Location: ../');

    ?>