document.addEventListener("DOMContentLoaded", function() {	

	function makeXHR(method, url, async, data, type) {
		'use strict';
		return new Promise((resolve, reject) => {
			let xhr = new XMLHttpRequest();
			xhr.open(method, url, async);
			if (type) xhr.responseType = type;
			xhr.addEventListener('load', () => {
				if (xhr.status === 200) {
					resolve(xhr.response);
				} else {
					reject({
						status: xhr.status,
						statusText: xhr.statusText
					});
				}
			}, false);
			xhr.addEventListener('error', () => {
				reject({
					status: xhr.status,
					statusText: xhr.statusText
				});
			}, false);
			if (data) {
				xhr.send(data);
			} else {
				xhr.send(null);
			}
		});
	};
	const ADMIN = (function() {
		return {
			ordersFoodBtn: document.getElementsByClassName('orders-food-a')[0],
			contentDiv: document.getElementsByClassName('main__content')[0],
			self: {
				el: undefined
			}
		}
	})();

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
			input.id = "input";
			input.className="input-dolg";
			input.value = temp;
			input.addEventListener("blur", removeInput);
			var dataset = this.dataset;
			var params = buildInputAttr(dataset, temp);
			setInputFilter(input, filterInputValue, params);
			
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
			return params;
		}
		function buildInputAttrPass(dataset, value, pass) {
			var params = {};
			for (let key in dataset) {
				params[key] = dataset[key];
			}
			params.value = value;
			params.pass = pass;
			return params;
		}
		
		function setInputFilter(textbox, inputFilter, params) {
		  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
			textbox.addEventListener(event, function() {
				if ($(this).val() != '') {
					var pattern = /^[нН]+$/i;
					if (pattern.test($(this).val())) {
						modalnoe(params);						
					} 
				} 
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
		function setInputFilterModal(textbox, inputFilter, params) {
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
		
		document.forms.modal_form.elements.modal_submit.addEventListener("click", sendDolg.bind(modal_form));
		function sendDolg() {
			passtest = document.querySelector('.passtest');
			var temp = modalInput.value;
			var parent = this.parentNode;
			var dataset = parent.dataset;
			var test = passtest.value;
			var value = buildInputAttrPass(dataset, temp, test);
			value['why'] = document.querySelector('.form-control-bottom').value;
			
			page = "ajax/edit_journ.php";
			updateValue(buildURL(page, value));
			var item = $('.editable[data-date="'+value['date']+'"][data-obj="'+value['obj']+'"][data-user="'+value['user']+'"]');

			item['0'].innerHTML=temp;
			modalInput.value = 'н';
			modal.classList.remove('modal_visible');
			main.classList.remove('main_blur');
		}

		function modalnoe(params) {
			let id = params.obj;
			console.log(id);
			let data = new FormData();
			data.append('id', id);
			makeXHR('POST', 'ajax/render.php', true, data)
			.then(response => {
				ADMIN.contentDiv.innerHTML = response;
			})
            .catch(error => {
                console.log(`Error:  ${error.statusText}`);
            });
			modal.classList.add('modal_visible');
			main.classList.add('main_blur');
			setInputFilterModal(modalInput, filterInputValue, params);
			for (let key in params) {
				modalForm.setAttribute('data-'+key, params[key]);
			}
		}
		let modal = document.querySelector('.modal'),
		main = document.querySelector('.main'),
		overlay = document.querySelector('.modal__overlay'),
		modalCloseButton = document.querySelector('.modal__close-icon');
		modalForm = document.querySelector('.modal__window');
		modalInput = document.querySelector('.modalInput');

		modalCloseButton.addEventListener('click', function(e) {
			e.preventDefault();
			modal.classList.remove('modal_visible');
			main.classList.remove('main_blur');
		
		})

		document.body.addEventListener('keyup', function (e) {
			let key = e.keyCode;
			if (key == 27) {
				modal.classList.remove('modal_visible');
				main.classList.remove('main_blur');
			};
		}, false);

		modal.addEventListener('click', function(e) {
			if (e.target === overlay) {
				modal.classList.remove('modal_visible');
				main.classList.remove('main_blur');
			}
		});


		function filterInputValue(value) {
			return /^[2345Нн]$/i.test(value) || (value === "");
		}
		
	}

);