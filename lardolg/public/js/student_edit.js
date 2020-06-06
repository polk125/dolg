document.addEventListener("DOMContentLoaded", function() {

    let modal = document.querySelector('.modal');
    var lass = document.querySelector('#class');
        lass.addEventListener("change", removeclass);
    var parent = document.querySelector('#parent');
        parent.addEventListener("change", removeparent);
        function removeclass() {
            var temp = {};
                temp['value'] = this.value;
                temp['id'] = this.dataset['id'];
            page = "../edit/class";
            updateValue(page, temp);
        }
        function removeparent() {
            var temp = {};
                temp['value'] = this.value;
                temp['id'] = this.dataset['id'];
            
            page = "../edit/parent";
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
});