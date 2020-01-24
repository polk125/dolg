document.addEventListener("DOMContentLoaded", function() {
	getEvents();
	
	document.querySelector(".form-control").addEventListener("change", function() {
		getEvents(this.value);
	});
	
	function getEvents(value) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.querySelector(".card-deck").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "ajax/get_events.php?value=" + value, true);
		xmlhttp.send();	
	}
});