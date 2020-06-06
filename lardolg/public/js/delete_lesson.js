document.addEventListener("DOMContentLoaded", function() {
    
    $('tbody').on('click', '.close',  function(){
        let del = confirm('Удалить?');
        if (!del) return;
        delit = this;
        console.log(this.closest("tr"));
            var temp = this.dataset['id'];
            page = "delete/lesson";
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
    
        
        
        
    
});