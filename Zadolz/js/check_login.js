document.addEventListener("DOMContentLoaded", function() {
	document.forms.auth_form.elements.auth_submit.addEventListener("click", check_login.bind(auth_form));
});

function check_login() {
	var formData = new FormData(this);
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var alert_danger = document.querySelector(".auth .alert-danger");
			alert_danger.classList.remove("alert-show");
			console.log(this.responseText);
			switch (this.responseText) {
				case "Заполните все поля!":
					alert_danger.classList.add("alert-show");
					alert_danger.innerHTML = "Заполните все поля!";
					break;				
				case "Неверный логин или пароль!":
					alert_danger.classList.add("alert-show");
					alert_danger.innerHTML = "Неверный логин или пароль!";
					break;
				case "Ok":
					window.location.href = "lk/index.php";
					break;
				default:
					alert_danger.classList.add("alert-show");
					alert_danger.innerHTML = "При авторизации произошла ошибка!";
			}
		}
	};
	xmlhttp.open("POST", "check_login.php", true);
	xmlhttp.send(formData);
}