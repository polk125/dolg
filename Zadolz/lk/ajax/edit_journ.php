<?php
$conn = new PDO(
    "mysql:host=localhost;dbname=zadolz;charset=utf8",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);

$result = $conn->prepare("SELECT teacherid, lessonid FROM lessonteacher
WHERE id = ?");
$result->execute([$_GET['obj']]);
$subject = $result->fetch();
print_r($subject);

if (preg_match('/^[2345Нн]+$/', $_GET['value'])) {
    $result = $conn->prepare("SELECT * FROM pass WHERE studid=? AND teacherid=? AND leasonid=? AND date=?");
    $result->execute([$_GET['user'], $subject['teacherid'], $subject['lessonid'], $_GET['date']]);
    if(!isset($_GET['pass'])){
    $_GET['pass']='0';
    }
    $value=$result->fetch();
    if($value!=''){
        $result = $conn->prepare(" UPDATE pass SET value='$_GET[value]' WHERE studid=? AND teacherid=? AND leasonid=? AND date=?");
        $result->execute([$_GET['user'], $subject['teacherid'], $subject['lessonid'], $_GET['date']]);
        $result = $conn->prepare(" UPDATE pass SET why='$_GET[why]' WHERE studid=? AND teacherid=? AND leasonid=? AND date=?");
        $result->execute([$_GET['user'], $subject['teacherid'], $subject['lessonid'], $_GET['date']]);
        $result = $conn->prepare(" UPDATE pass SET testid='$_GET[pass]' WHERE studid=? AND teacherid=? AND leasonid=? AND date=?");
        $result->execute([$_GET['user'], $subject['teacherid'], $subject['lessonid'], $_GET['date']]);
    }else{
    $result = $conn->prepare("INSERT INTO pass (studid, teacherid, leasonid, value, tire, why, testid, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $result->execute([$_GET['user'], $subject['teacherid'], $subject['lessonid'], $_GET['value'], '0', $_GET['why']||'', $_GET['pass'], $_GET['date']]);
    }
} elseif ($_GET['value']==="") {
    $result = $conn->prepare("DELETE FROM pass 
WHERE studid=? AND teacherid=? AND leasonid=? AND date=?");
    $result->execute([$_GET['user'], $subject['teacherid'], $subject['lessonid'], $_GET['date']]);
}