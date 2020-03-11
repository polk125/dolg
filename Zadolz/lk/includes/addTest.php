<script src="js/jquery.js"></script>
<script src="js/add_test.js"></script>
<?php if(!isset($_POST['number']) && !isset($_POST['quest-submit'])){ 
$conn = new PDO(
    "mysql:host=localhost;dbname=zadolz;charset=utf8",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);


$objs= $conn->query("SELECT * FROM lesson")->fetchAll();
?>


    <form id="addadminch" class="admin-test-form" enctype="multipart/form-data" action="tests.php?tests=new" method="POST">
    <label for="name">Название теста*</label>
    <input type="text" name="name" id="login" required><br>
	<label for="name">Тема*</label>
    <input type="text" name="theme" id="login" required><br>
    <label for="number">Количество вопросов*</label>
    <input type="number" min="1" value="1" name="number" id="login" required><br>
    <label for="obj" >Предмет*</label>
    <select name="obj" required>
    <?php foreach ($objs as $obj): ?>
        <option value="<?=$obj['id']?>"><?=$obj['name']?></option>
    <?php endforeach;?>			
    </select><br>
    <label for="img"0>Загружаемые файлы</label> 
    <input class="load" type="file" name="test_load" id="question<?=$question?>_img"><br>
    <p>* - обязательные поля</p>
    <input class="admin-btn" type="submit" value="Создать">
    
    </form>



<?php
}elseif(isset($_POST['number'])){

	echo '<div class="new-test"><p>Тест: '.$_POST['name'].'</p><form  class="form-question" name="form-question" enctype="multipart/form-data" action="tests.php?tests=new" method="POST">
	<div id="add_field_area" class="add_field_area">
	<input type="hidden" name="test-name" value="'.$_POST['name'].'"/>
	<input type="hidden" name="test-theme" value="'.$_POST['theme'].'"/>
    <input type="hidden" name="quest-type"  value="'.$_POST['obj'].'"/>';
    
    $load='';
    if (is_uploaded_file($_FILES["test_load"]["tmp_name"])) {
		$file_exploded = explode(".", $_FILES["test_load"]["name"]);
		$file = $file_exploded[0];
		$ext = $file_exploded[1];
		$load =$file.'.'.$ext;
		move_uploaded_file($_FILES["test_load"]["tmp_name"], "docs/".$file.".".$ext);
    }
    echo '<input type="hidden" name="quest-load"  value="'.$load.'"/>';
	for($question=1; $question<=$_POST['number']; $question++){
		if($question==1){?>

			<div id="add1" class="add">
                    <label> Вопрос №1</label><br>
                    <textarea  type="text"name="question1" id="val" onblur="writeFieldsVlues();"></textarea><br>
					<label for="img"0>Загружаемые файлы для вопроса</label> 
					<input class="load" type="file" name="question<?=$question?>_img" id="question<?=$question?>_img">
              
		<?
		}else{
		?>
    <div id="add<?=$question?>" class="add"><hr>
                    <label> Вопрос №<?=$question?></label><br>
                    <textarea type="text" name="question<?=$question?>" id="val" onblur="writeFieldsVlues();"  value="<?=$value?>"></textarea><br>
                    <div class="deletebutton" onclick="deleteField(<?=$question?>);"></div>
					<label for="img"0>Загружаемые файлы для вопроса</label> 
					<input class="load" type="file" name="question<?=$question?>_img" id="question<?=$question?>_img">
                    
                
	<?php
	}
    for($answer=1; $answer<=2; $answer++){
		echo '<div class="answer" id="answer'.$answer.'"><label for="answer">Ответ: '.$answer.' </label><input type=text id="question'.$question.'" name="question'.$question.' answer'.$answer.'">
		<input type="checkbox" class="correct" name="question'.$question.'_answer'.$answer.'_correct" id="question'.$question.'_answer'.$answer.'_correct"><label>Верный ответ</label>
		<br><label for="img"0>Загружаемые файлы для ответа</label> <input class="load" type="file" name="question'.$question.'_answer'.$answer.'_img" id="question'.$question.'_answer'.$answer.'_img"></div>';
		
	}
	
	echo '</div>';
	?>
	<div id="delete<?=$question?>" onclick="addFieldAnswer(<?=$question?>);" class="addbutton">Добавить новый ответ</div>
	<?php
    }

?>

	</div><div onclick="addField();" class="addbutton">Добавить новый вопрос</div>
		<input name="quest-submit" class="admin-btn" type="submit" value="Создать">
		</form></div>
        
<?php 
}elseif(isset($_POST['quest-submit'])){ 
$stuck = array();
foreach($_POST as $key => $all):
	if(strripos($key,'answer')!==false && strripos($key,'correct')===false){
		$keys = explode( "_",$key);
		$stuck[$keys[0]][$keys[1]]=$all;
	}elseif(strripos($key,'answer')===false && strripos($key,'question')!==false && strripos($key,'img')===false){
		$stuck[$key]['name'] = $all;
	}
endforeach;
$sql1 = 'INSERT INTO tests (id,name,teacherid,lessonid,include,theme) VALUES(NULL,\''.$_POST['test-name'].'\',\''.$_COOKIE['user'].'\',\''.$_POST['quest-type'].'\',\''.$_POST['quest-load'].'\',\''.$_POST['test-theme'].'\');  SET @test_id = LAST_INSERT_ID();';

$conn = new PDO(
	"mysql:host=localhost;dbname=zadolz;charset=utf8",
	"root",
	"",
	[
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	]
);
foreach($stuck as  $kluch =>$array):
	$img=='';
	if (is_uploaded_file($_FILES[$kluch."_img"]["tmp_name"])) {
		$file_exploded = explode(".", $_FILES[$kluch."_img"]["name"]);
		$file = $file_exploded[0];
		$ext = $file_exploded[1];
		$img =$file.'.'.$ext;
		move_uploaded_file($_FILES[$kluch."_img"]["tmp_name"], "docs/".$file.".".$ext);
	}
	foreach($array as $key => $insert):
		$imgquestion='';
		if (is_uploaded_file($_FILES[$kluch."_".$key."_img"]["tmp_name"])) {
			$file_exploded = explode(".", $_FILES[$kluch."_".$key."_img"]["name"]);
			$file = $file_exploded[0];
			$ext = $file_exploded[1];
			$imgquestion = $file.'.'.$ext;
			move_uploaded_file($_FILES[$kluch."_".$key."_img"]["tmp_name"], "docs/".$file.".".$ext);
		}
		$correct=0;
		if(isset($_POST[$kluch."_".$key."_correct"]))
		{
			$correct=1;
		}
		if($key=='name'){
			
			$sql1.= 'INSERT INTO questions (id,question,quality,include,testid) VALUES(NULL,\''.$insert.'\',\'3\',\''.$img.'\',@test_id);  SET @question_id = LAST_INSERT_ID();';

		}elseif($insert!==''){
		$sql1.= 'INSERT INTO answers (id,questionid,text,include,correct) VALUES(NULL,@question_id,\''.$insert.'\',\''.$imgquestion.'\',\''.$correct.'\');';
		}
	endforeach;
endforeach;
$objs= $conn->query($sql1);
?>
<div class="new-test">
<p>Отправка теста</p>
Тест успешно добавлен

</div>
<?php

}
?>
