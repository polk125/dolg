<?php
    session_start();
    if (!isset($_COOKIE['user'])) {
        header('Location: ../../auth.php');
    } 

    include('../db.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $delete_sql = "DELETE FROM users WHERE id = '$id'";
    mysqli_query($conn, $delete_sql);

    $conn->close();
    header('Location: ../index.php');
?>