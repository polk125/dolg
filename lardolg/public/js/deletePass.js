document.addEventListener("DOMContentLoaded", function() {

	var cells = document.querySelectorAll('.table tbody tr td .close');
    for(var i = 0; i < cells.length; i++) {
        cells[i].addEventListener("click", modalnoe);
	}
		let modal = document.querySelector('.modal'),
		main = document.querySelector('.main'),
		overlay = document.querySelector('.modal__overlay'),
		modalCloseButton = document.querySelector('.modal__close-icon');
		modalForm = document.querySelector('.modal__window');
		modalInput = document.querySelector('.modalInput');

		function modalnoe() {
			var dataset = this.dataset;
			var temp = this.innerHTML;
			var params = buildInputAttr(dataset, temp);
			let id = params.obj;
			let data = new FormData();
			data.append('id', id);
			modal.classList.add('modal_visible');
			main.classList.add('main_blur');
			setInputFilterModal(modalInput, filterInputValue);
			for (let key in params) {
				modalForm.setAttribute('data-'+key, params[key]);
			}
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
		function updateValue(page, params) {
            $.ajax({
                url: page,
                type: "POST",
                data: {params},
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                console.log(data);
                },
                error: function (msg) {
				alert('msg');
				console.log(msg);
                }
                });
		}
		
		function setInputFilterModal(textbox, inputFilter) {
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
			var temp = modalInput.value;
			var parent = this.parentNode;
			var dataset = parent.dataset;
			var value = buildInputAttrPass(dataset, temp);
			page = "ajax/delete";
			updateValue(page, value);

            var item = $('[data-id="'+value['id']+'"]').closest('tr');
			item.hide('slow', function(){ item.remove(); });
			modal.classList.remove('modal_visible');
			main.classList.remove('main_blur');
		}

		
		
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