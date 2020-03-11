
<?php
include('includes/db.php');

if(!isset($_GET['id'])){
    $obects= $conn->query("SELECT * FROM lesson")->fetchAll();
?>
<form method="post" class="journ_month" id="MyForm">
				Предмет
				<select name="object" onchange="document.getElementById('MyForm').submit()">
                <option value="all">Все предметы</option>
                <?php foreach ($obects as $obect): ?>
                    <option <?php if(isset($_POST['object'])){if($_POST['object']===$obect['id']){echo"selected";}}?> value="<?=$obect['id']?>"><?=$obect['name']?></option>
                <?php endforeach;?>	

                </select>
				</form>
<?php
        if(isset($_POST['object']) && $_POST['object']!=='all'){
            $objName= $conn->query("SELECT * FROM tests WHERE lessonid='$_POST[object]' ")->fetchAll();        
        }else{
            $objName= $conn->query("SELECT * FROM tests ")->fetchAll();
        }
        foreach($objName as $objects):
            if(isset($objects['id'])){
                
                ?>
                <div class="test" ><a class="header-href" href="tests.php?id=<?=$objects['id']?>"><?=$objects['name'] ?></a>
                <p>Тема - <?=$objects['theme']?></p>
                <?php 
                $who= $conn->query("SELECT name, surname, patronymic FROM users WHERE id='$objects[teacherid]'")->fetch();
                ?>
                <p>Автор: <?=$who['name']?> <?=$who['surname']?> <?=$who['patronymic']?></p>
                <?php if(substr($objects['include'], -3)=='png'|| substr($objects['include'], -3)=='jpg')
                {
                    echo'<a class="header-img" href="tests.php?id='.$objects['id'].'"><img  src=docs/'.$objects['include'].' ></a>';
                }  ?>
                <br><a class="look" href="tests.php?id=<?=$objects['id']?>">Просмотр</a>
                </div>
                <?php
            }
        endforeach;

}else{
    $objName= $conn->query("SELECT * FROM tests WHERE id='$_GET[id]'")->fetch();
    $who= $conn->query("SELECT name, surname, patronymic FROM users WHERE id='$objName[teacherid]'")->fetch();
?>
    <div class="example">
    <h1><?=$objName['name']?></h1>
    <p><?=$who['name'].' '.$who['surname'].' '.$who['patronomic']?></p>
    <?php if(substr($objName['include'], -3)=='png'|| substr($objName['include'], -3)=='jpg')
                {
                    echo'<img  src=docs/'.$objName['include'].' >';
                }  ?>
    </div>
<?php
$obj= $conn->query("SELECT * FROM questions WHERE testid='$objName[id]'")->fetchAll();
foreach($obj as $objs):

?>
<div class="question">
<h3><?=$objs['question']?></h3>
<?php
 if(substr($objects['include'], -3)=='png'|| substr($objects['include'], -3)=='jpg')
{
    echo'<a class="header-img" href="tests.php?id='.$objects['id'].'"><img  src=docs/'.$objects['include'].' ></a>';
}  
$answer= $conn->query("SELECT * FROM answers WHERE questionid='$objs[id]'")->fetchAll();
$numb= 0;
foreach($answer as $answers):
    $numb++;
    if($answers['correct']==1){
        
    ?>
        <div class="answer correct">Ответ <?=$numb.': '.$answers['text']?> (правельный)<br>
        <?php if(substr($answers['include'], -3)=='png'|| substr($answers['include'], -3)=='jpg')
                {
                    echo'<img  src=docs/'.$answers['include'].' >';
                }  ?>
        </div>
    <?php
}else{
    echo '<div class="answer ">Ответ '.$numb.': '.$answers['text'].'</div>';
    if(substr($answers['include'], -3)=='png'|| substr($answers['include'], -3)=='jpg')
                {
                    echo'<img  src=docs/'.$answers['include'].' >';
                }
}
endforeach;

echo '</div>';
endforeach;


}
?>