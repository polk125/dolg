function addField () {
	var telnum = parseInt($('#add_field_area').find('div.add:last').attr('id').slice(3))+1;
	var answers = ''; 
	for (let i = 1; i <= 2; i++) { 
		if(i==1){
		answer = '<div class="answer" id="answer'+i+'"><label for="answer">Ответ: '+i+' </label><input type=text id="question'+telnum+'" name="question'+telnum+' answer'+i+'"><input class="correct" type="checkbox" name="question'+telnum+'_answer'+i+'_correct" id="question'+telnum+'_answer'+i+'_correct"><label>Верный ответ</label><br><label for="img"0>Загружаемые файлы для ответа</label> <input type="file" class="load" name="question'+telnum+'_answer'+i+'_img" id="question'+telnum+'_answer'+i+'_img"></div>';
		}else{
		answer = answer + '<div class="answer" id="answer'+i+'"><label for="answer">Ответ: '+i+' </label><input type=text id="question'+telnum+'" name="question'+telnum+' answer'+i+'"><input class="correct" type="checkbox" name="question'+telnum+'_answer'+i+'_correct" id="question'+telnum+'_answer'+i+'_correct"><label>Верный ответ</label><br><label for="img"0>Загружаемые файлы для ответа</label> <input type="file" class="load" name="question'+telnum+'_answer'+i+'_img" id="question'+telnum+'_answer'+i+'_img"></div>';
		}
	}

	$('div#add_field_area').append('<div id="add'+telnum+'" class="add"><hr><label> Вопрос №'+telnum+'</label><br><textarea type="text" name="question'+telnum+'" id="val" onblur="writeFieldsVlues();"  value=""></textarea><br><div class="deletebutton" onclick="deleteField('+telnum+');"></div><label for="img"0>Загружаемые файлы</label><input class="load" type="file" name="question'+telnum+'_img" id="question'+telnum+'_img">'+answer+'</div><div id="delete'+telnum+'" onclick="addFieldAnswer('+telnum+');" class="addbutton">Добавить новый ответ</div>');
}
function addFieldAnswer (question) {
	var telnum = parseInt($('#add'+question).find('div.answer:last').attr('id').slice(6))+1;
	var answers = ''; 
	delet='';
	if(telnum>=3){
		delet = '<div class="deletebuttonDelete" onclick="deleteFieldAnswer('+question+','+telnum+');"></div>';
	}
	$('div#add'+question).append('<div id="answer'+telnum+'" class="answer"><label for="answer">'+delet+'Ответ: '+telnum+'</label><input  type=text id="question'+question+'" name="question'+question+' answer'+telnum+'"><input type="checkbox" class="correct" name="question'+question+'_answer'+telnum+'_correct" id="question'+telnum+'_answer'+telnum+'_correct"><label>Верный ответ</label><br><label for="img"0>Загружаемые файлы для ответа</label> <input class="load" type="file" name="question'+question+'_answer'+telnum+'_img" id="question'+question+'_answer'+telnum+'_img"></div>');
}
function deleteFieldAnswer (id, answer){
	$('div#add'+id+' div#answer'+answer).remove();
}

function deleteField (id) {
	$('div#add'+id).remove();
	$('div#delete'+id).remove();
}