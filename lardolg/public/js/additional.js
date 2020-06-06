document.addEventListener("DOMContentLoaded", function() {

 
    $('div.admin').on('click', '.add-student',  function(){
        var temp = {};
        temp['value'] = this.value;
        temp['id'] = this.dataset['id'];
        that=this;
        page = "addstudent";
        $.ajax({
            url:page,
            type: "POST",
            data: {temp},
            headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                
                that.closest(".card").querySelector('#count').innerHTML = data;
                if(temp['value']==1){
                    that.innerHTML = "Зарегистрироваться";
                    that.value=0;
                }else{
                    that.value=1;
                    that.innerHTML = "Отписаться";
                }
                  
            },
            error: function (msg) {
                console.log(msg)
            }
            });
    });
   });