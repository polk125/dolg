document.addEventListener("DOMContentLoaded", function() {
	document.forms.contacts_form.elements.submit_btn.addEventListener("click", check_form.bind(contacts_form));
});

function check_form() {
	var formData = new FormData(this);
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			
			console.log(this.responseText);
			var alert_danger = document.querySelector(".contacts-upper .alert-danger");
			var alert_success = document.querySelector(".contacts-upper .alert-success");
			alert_danger.classList.remove("alert-show");
			alert_success.classList.remove("alert-show");
			
			switch (this.responseText) {
				case "Заполните все поля!":
					alert_danger.classList.add("alert-show");
					alert_danger.innerHTML = "Заполните все поля!";
					break;
				case "В имени могут содержаться только буквы и пробел!":
					alert_danger.classList.add("alert-show");
					alert_danger.innerHTML = "В имени могут содержаться только буквы и пробел!";
					break;
				case "Неверный формат E-mail!":
					alert_danger.classList.add("alert-show");
					alert_danger.innerHTML = "Неверный формат E-mail!";
					break;					
				default:
					alert_success.classList.add("alert-show");
			}
		}
	};
	xmlhttp.open("POST", "ajax/send_mail.php", true);
	xmlhttp.send(formData);
}

