document.addEventListener("DOMContentLoaded", function() {
    let modal = document.querySelector('.modal');
    var cells = document.querySelector('.add-information');
        cells.addEventListener("blur", removeInput);
        cellsvalue = cells.value;
    var phone = document.querySelector('#phone');
        phone.addEventListener("blur", removephone);
        phonevalue = phone.value;
        var email = document.querySelector('#e-mail');
        email.addEventListener("blur", removeemail);
        emailvalue = email.value;
        var addbutton = document.querySelector('.addbutton');
        addbutton.addEventListener("click", addField);
        
            


        $('div.social-needs').on('blur', '.social-add',  function(){
            var temp = {};
            temp['value'] = this.value;
            temp['id'] = this.dataset['id'];
         
            console.log(temp);
            if(cellsvalue == temp['value']){
                return false
            }
            page = "about/addhref";
            updateValueadd(page, temp, this);
        });
        $('div.social-needs').on('click', '.deletebutton',  function(){
            classes = this.dataset['class'];
            id = this.dataset['id'];
            console.log(id);
            if(id!=''){
                
                page="about/adddelete";
                deleteValueadd(page, id, classes)
            }else{
                $('div#social'+classes).remove();
            }

        });
        function deleteValueadd(page, temp, item) {
            $.ajax({
                url:page,
                type: "POST",
                data: {temp},
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('div#social'+item).remove();
                    modal.classList.add('modal_visible');
                    setTimeout(() => modal.classList.remove('modal_visible'), 2000);  
                },
                error: function (msg) {
                    console.log(msg)
                }
                });
        }
        function updateValueadd(page, temp, item) {
            $.ajax({
                url:page,
                type: "POST",
                data: {temp},
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if(data == 'delete'){
                       attr=$(item).attr('id');
                        $('div#'+attr).remove();
                        return false;
                    }
                    console.log(data)
                    item.dataset['id']=data;
                    if(item.closest(".social-group").querySelector('.deletebutton')){
                        item.closest(".social-group").querySelector('.deletebutton').dataset['id']=data;
                    }
                    modal.classList.add('modal_visible');
                    setTimeout(() => modal.classList.remove('modal_visible'), 2000);  
                },
                error: function (msg) {
                    console.log(msg)
                }
                });
        }



        function addField () {
            
            var telnum = parseInt($('.social-needs').find('div.social-group:last').attr('id').slice(-1))+1;
            if(telnum>5){
                return false;
            }
            $('div.social-needs').append('<div id="social'+telnum+'" class="form-group row social-group"><div data-class="'+telnum+'" class="deletebutton"  data-id=""></div><label for="social'+telnum+'" class="col-md-4 col-form-label text-md-right">Другой способ связи</label><div id="social'+telnum+'" class="col-md-6 add"><input id="social'+telnum+'" data-id="" type="text" class="form-control social-add" placeholder=""><span class="social-feedback-'+telnum+'" role="alert"><strong></strong></span></div></div>');
            }
            

    function removeInput() {
        var temp = this.value;
        if(cellsvalue == temp){
            return false
        }
        page = "about/add";
        updateValue(page, temp);
    }

    function removephone() {
        var temp = this.value;
        if(phonevalue == temp || temp.length<11){
            if(temp.length<11){
                document.querySelector('.phone-feedback').innerHTML =   "Введите полный номер";
            }
            return false
        }
        page = "about/phone";
        updateValue(page, temp);
    }
    function removeemail() {
        var temp = this.value;
        if(this.checkValidity() == false){
            return false
        }
        page = "about/email";
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
            }
            });
    }
} );