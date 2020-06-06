document.addEventListener("DOMContentLoaded", function() {

	var cells = document.querySelectorAll('.table tbody tr .editable');
    for(var i = 0; i < cells.length; i++) {
        cells[i].addEventListener("click", addInput);
	}
	const ADMIN = (function() {
		return {
			ordersFoodBtn: document.getElementsByClassName('orders-food-a')[0],
			contentDiv: document.getElementsByClassName('main__content')[0],
			self: {
				el: undefined
			}
		}
	})();

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
			params['why']='';
			params['test']=null;
			params['material']=null;
			page = "ajax/post";
			updateValue(page, params);

			this.remove();
			parent.innerHTML = temp;
			parent.addEventListener("click", addInput);
		}

		function updateValue(page, params) {
            $.ajax({
                url:page,
                type: "POST",
                data: {params},
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
					console.log(data);
                },
                error: function (msg) {
				console.log(msg);
                alert('msg');
                }
                });
		}

		function buildInputAttr(dataset, value) {
			var params = {};
			for (let key in dataset) {
				params[key] = dataset[key];
			}
			params.value = value;
			return params;
		}
		function buildInputAttrPass(dataset, value) {
			var params = {};
			for (let key in dataset) {
				params[key] = dataset[key];
			}
			params.value = value;
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
			var value = buildInputAttrPass(dataset, temp);
			value['why'] = document.querySelector('.form-control-bottom').value;
			value['test'] = null;
			value['material']=null;
			if(document.querySelector('#check').checked){
				value['test'] = document.querySelector('#testRender').value
				value['material'] = document.querySelector('#materialRender').value
			}
			page = "ajax/post";
			updateValue(page, value);

            var item = $('.editable[data-date="'+value['date']+'"][data-obj="'+value['obj']+'"][data-user="'+value['user']+'"]');
			item['0'].innerHTML=temp;
			modalInput.value = 'н';
			modal.classList.remove('modal_visible');
			main.classList.remove('main_blur');
		}

		function modalnoe(params) {

			$('.input-dolg').blur();
			let id = params.obj;
			let data = new FormData();
			data.append('id', id);
			// makeXHR('POST', 'ajax/render.php', true, data)
			// .then(response => {
			// 	ADMIN.contentDiv.innerHTML = response;
			// })
            // .catch(error => {
            //     console.log(`Error:  ${error.statusText}`);
			// });
			$.ajax({
                url: "ajax/renderTests",
                type: "GET",
                data: {params},
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
					ADMIN.contentDiv.innerHTML = data;
                },
                error: function (msg) {
				alert('msg');
				console.log(msg);
                }
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