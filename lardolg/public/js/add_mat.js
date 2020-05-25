function addField () {
	var telnum = parseInt($('#add_field_area').find('div.add:last').attr('id').slice(3))+1;
	$('div#add_field_area').append('<div id="add'+telnum+'" class="add"><hr><div class="deletebutton" onclick="deleteField('+telnum+');"></div><label for="img"0>Загружаемый файл №'+telnum+'</label><input class="load" type="file" name="question'+telnum+'_img" id="question'+telnum+'_img"></div>');
}
function deleteField (id) {
	$('div#add'+id).remove();
	$('div#delete'+id).remove();
}