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
$obects= $conn->query("SELECT * FROM tests WHERE lessonid ='$_POST[id]' ")->fetchAll();
?>
<select  name="pass-test" class="passtest">
<?php foreach ($obects as $obect): 
    $name= $conn->query("SELECT * FROM users WHERE id='$obect[teacherid]'")->fetch();
    ?>
    <option value="<?=$obect['id']?>">Тест: <?=$obect['name']?> Автор: <?=$name['surname'].' '.mb_substr($name['surname'], 0, 1).'.'.mb_substr($name['patronymic'], 0, 1).'.'?></option>
<?php endforeach;?>	

</select>
<?php
?>
