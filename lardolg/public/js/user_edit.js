document.addEventListener("DOMContentLoaded", function() {
    let modal = document.querySelector('.modal');
    var phone = document.querySelector('#phone');
        phone.addEventListener("blur", removephone);
        phonevalue = phone.value;
    var email = document.querySelector('#e-mail');
        email.addEventListener("blur", removeemail);
        emailvalue = email.value;
    var about = document.querySelector('.add-information');
        about.addEventListener("blur", removeabout);
        aboutvalue = about.value;  
    var pass = document.querySelector('.new-password');
        pass.addEventListener("click", newpass);
        

        function newpass() {
            var temp = this.dataset['id'];
            page = "../edit/newpass";
            $.ajax({
                url:page,
                type: "POST",
                data: {temp},
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    modal.classList.add('modal_visible');
                    setTimeout(() => modal.classList.remove('modal_visible'), 2000);
                    document.querySelector('#new-password').innerHTML=data;
                    document.querySelector('#new-password').style.visibility= 'visible';
                },
                error: function (msg) {
                    console.log(msg);
                }
                });
        }
        function removeabout() {
            var temp = {};
            temp['value'] = this.value;
            temp['id'] = this.dataset['id'];
            if(aboutvalue == temp['value']){
                return false
            }
            page = "../edit/add";
            updateValue(page, temp);
        }
    function removephone() {
        var temp = {};
            temp['value'] = this.value;
            temp['id'] = this.dataset['id'];
        if(phonevalue == temp['value'] || temp['value'].length<11){
            if(temp.length<11){
                document.querySelector('.phone-feedback').innerHTML="Введите полный номер";
            }
            return false
        }
        page = "../edit/phone";
        updateValue(page, temp);
    }
    function removeemail() {
        var temp = {};
            temp['value'] = this.value;
            temp['id'] = this.dataset['id'];
        if(this.checkValidity() == false || temp['value'] == emailvalue){
            return false
        }
        page = "../edit/email";
        updateValue(page, temp);
    }
    function updateValue(page, temp) {
        $.ajax({
            url:page,
            type: "POST",
            data: {temp},
            headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                modal.classList.add('modal_visible');
                setTimeout(() => modal.classList.remove('modal_visible'), 2000);
            },
            error: function (msg) {
                console.log(msg);
            }
            });
    }
} );