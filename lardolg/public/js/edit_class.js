document.addEventListener("DOMContentLoaded", function() {

    let modal = document.querySelector('.modal');
    var lass = document.querySelector('#teacher');
        lass.addEventListener("change", removeteacher);
    var addlesson = document.querySelector('#addlesson');
        addlesson.addEventListener("change", addField);


        $('tbody').on('click', '.close',  function(){
            let del = confirm('Удалить?');
            if (!del) return;
            delit = this;
            console.log(this.closest("tr"));
                var temp = this.dataset['id'];
                page = "../delete/lessonteacher";
                console.log(temp);
                $.ajax({
                    url:page,
                    type: "POST",
                    data: {temp},
                    headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        delit.closest("tr").style.opacity = 0; 
                        setTimeout(() => delit.closest("tr").remove(), 1000);
                    },
                    error: function (msg) {
                        console.log(msg)
                        
                    }
                    });
        });

        function addField () {
            var temp = {};
            temp['value'] = this.value;
            temp['id'] = this.dataset['set'];
            temp['num'] = parseInt($('#lessonteacher').find('tr:last')[0].dataset['num']) + 1;
            page="../ajax/addlessons";
            $.ajax({
                url:page,
                type: "POST",
                data: {temp},
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log(data);
                    $('#lessonteacher').append(data);
                },
                error: function (msg) {
                    console.log(msg);
                }
                });
        }

        $('tbody#lessonteacher').on('change', '#addlessonteacher',  function(){
            var temp = {};
            temp['value'] = this.value;
            temp['id'] = this.dataset['set'];
         
            console.log(temp);
            page = "../edit/lessonteacher";
            updateValue(page, temp, this);
        });




        function removeteacher() {
            var temp = {};
                temp['value'] = this.value;
                temp['id'] = this.dataset['id'];
            page = "../editclass/teacher";
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
                    setTimeout(() => modal.classList.remove('modal_visible'), 1000);
                },
                error: function (msg) {
                    console.log(msg);
                }
                });
        }
});