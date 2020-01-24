document.addEventListener("DOMContentLoaded", function() {	
	var cells = document.querySelectorAll('.table tbody tr .editable');
    for(var i = 0; i < cells.length; i++) {
        cells[i].addEventListener("click", addInput);
    }

		function addInput() {
			this.removeEventListener("click", addInput);
			var temp = this.innerHTML;
			this.innerHTML = "";
			var input = document.createElement("input");
			input.type = "text";
			input.value = temp;
			input.addEventListener("blur", removeInput);
			
			setInputFilter(input, filterInputValue);
			
			this.appendChild(input);
			input.focus();
			input.setSelectionRange(0, input.value.length)
		}

		function removeInput() {
			var temp = this.value;
			var parent = this.parentNode;
			var dataset = parent.dataset;

			var params = buildInputAttr(dataset, temp);
			page = "ajax/edit_journ.php";
			updateValue(buildURL(page, params));
			
			this.remove();
			parent.innerHTML = temp;
			parent.addEventListener("click", addInput);
		}

		function updateValue(url) {
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			}
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var response = this.responseText;
					console.log(response);
				}
			};
			xmlhttp.open("GET", url, true);
			xmlhttp.send();
		}
		
		function buildURL(page, params) {
			url = page + "?";
			for (let key in params) {
				url = url + key + "=" + params[key] + "&";
			}
			url = url.substring(0, url.length - 1);
			console.log(url);
			return url;		
		}
		
		function buildInputAttr(dataset, value) {
			var params = {};
			for (let key in dataset) {
				params[key] = dataset[key];
			}
			params.value = value;
			console.log(params);
			return params;
		}
		
		function setInputFilter(textbox, inputFilter) {
		  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
			textbox.addEventListener(event, function() {
			  if (inputFilter(this.value)) {
				this.oldValue = this.value;
				this.oldSelectionStart = this.selectionStart;
				this.oldSelectionEnd = this.selectionEnd;
			  } else if (this.hasOwnProperty("oldValue")) {
				this.value = this.oldValue;
				this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			  } else {
				this.value = "";
			  }
			});
		  });
		}
		
		function filterInputValue(value) {
			return /^[2345Нн.-]$/i.test(value) || (value === "");
		}		
	}
);