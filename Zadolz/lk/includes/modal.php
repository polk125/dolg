<!-- Элементы для вызова модальных окон, могут быть любые -->
<link rel="stylesheet" href="css/stile.css">
<script src="js/jquery.js"></script>
<div class="modal">
        <div class="modal__overlay"></div>
        <div class="modal__window">
            <h2 class="modal__title">Заголовок</h2>
            <form name="modal_form" class="modal__text" method="post">
					<div class="form-group">
						<div class="input-group-my modal-input">
                        <label>Оценка</label>
							<input type="text" name="modal_dolg" class="form-control modalInput" value="н">
						</div>
                    </div>
                    <label for="check">С возможностью исправить</label>
                    <input id="check" type="checkbox" checked="checked" onclick="if(this.checked){document.querySelector('.hiden').style.display=''}else {document.querySelector('.hiden').style.display='none';  document.querySelector('.form-control-bottom').value='';}">
					<div class="form-group hiden">
					<label>Тест для исправления </label><div class="main__content">
					</div>
					</div>
					<div class="form-group why">
						<div class="input-group-my">
							<label>Причина </label>
							<textarea type="text" name="modal_why" class="form-control form-control-bottom" placeholder="Можно пропустить"></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<input type="button" name="modal_submit" class="btn btn-outline-primary" value="ОК">
					</div>
					
				</form>
            <div class="modal__close-icon">
                <i class="far fa-window-close"></i>
            </div>
        </div>
    </div>