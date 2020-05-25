window.addEventListener('load', () => {
    let editArticleBtn = document.getElementsByClassName('edit-new-name')[0];
    let article = document.getElementsByClassName('new-name');
    let value = article.value;
    let modal = document.querySelector('.modal');
	let main = document.querySelector('.main');
    document.getElementsByClassName('new-name')[0]
    .addEventListener('keyup', (event) => {
    if (event.target.value !== value) {
        editArticleBtn.removeAttribute('disabled');
    } else {
        editArticleBtn.setAttribute('disabled', '');
        }
    }, false);
    editArticleBtn.addEventListener('click', (event) => {
        let id = editArticleBtn.value;
        let value = document.getElementsByClassName('new-name')[0].value;
        var data = {};
        data['id']=id;
        data['new_name']=value;
        console.log(data);
        $.ajax({
            url: "../ajaxEditMaterial/editName",
            type: "POST",
            data: {data},
            headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                document.getElementsByClassName('new-name')[0].value=data;
                modal.classList.add('modal_visible');
                setTimeout(() => modal.classList.remove('modal_visible'), 2000);
            },
            error: function (msg) {
            console.log(msg);
            }
        });
    }, false);


    editThemeBtn = document.getElementsByClassName('edit-new-theme')[0];
    theme = document.getElementsByClassName('new-theme');
    value = theme.value;
    console.log(document.getElementsByClassName('new-theme')[0]);
    document.getElementsByClassName('new-theme')[0]
    .addEventListener('keyup', (event) => {
    if (event.target.value !== value) {
        
        editThemeBtn.removeAttribute('disabled');
    } else {
        editThemeBtn.setAttribute('disabled', '');
        }
    }, false);
    editThemeBtn.addEventListener('click', (event) => {
        id = editThemeBtn.value;
        value = document.getElementsByClassName('new-theme')[0].value;
        data = {};
        data['id']=id;
        data['new_theme']=value;
        console.log(data);
        $.ajax({
            url: "../ajaxEditMaterial/editTheme",
            type: "POST",
            data: {data},
            headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                document.getElementsByClassName('new-theme')[0].value=data;
                modal.classList.add('modal_visible');
                setTimeout(() => modal.classList.remove('modal_visible'), 2000);
            },
            error: function (msg) {
            console.log(msg);
            }
        });
    }, false);

    editLessonBtn = document.getElementsByClassName('edit-new-lesson')[0];
    lesson = document.getElementsByClassName('new-lesson');
    value = lesson.value;
    document.getElementsByClassName('new-lesson')[0]
    .addEventListener('keyup', (event) => {
    if (event.target.value !== value) {
        editLessonBtn.removeAttribute('disabled');
    } else {
        editLessonBtn.setAttribute('disabled', '');
        }
    }, false);
    editLessonBtn.addEventListener('click', (event) => {
        id = editLessonBtn.value;
        value = document.getElementsByClassName('new-lesson')[0].value;
        data = {};
        data['id']=id;
        data['new_lesson']=value;
        console.log(data);
        $.ajax({
            url: "../ajaxEditMaterial/editLesson",
            type: "POST",
            data: {data},
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
    }, false);

    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('del-new')) {
            let del = confirm('Удалить?');
            if (!del) return;
            let id = event.target.value;
            $.ajax({
                url: "../ajaxEditMaterial/delete/"+id,
                type: "GET",
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    document.getElementsByClassName('new-lesson')[0].value=data;
                    modal.classList.add('modal_visible');
                    setTimeout(() => modal.classList.remove('modal_visible'), 2000);
                    document.location.href="../materials";
                },
                error: function (msg) {
                console.log(msg);
                }
            });
        }
    }, false);





    



    
    document.addEventListener('change', (event) => {
        if (event.target.classList.contains('input-new')) {
            var file_data = document.getElementById('question_img').files[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            console.log(form_data);
            $.ajax({
                url: "../mat/updateimg",
                type: "POST",
                data: form_data,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    document.getElementsByClassName('addedimg')[0].innerHTML="<div class='preloader'></div>";
                },
                success: function (data) {
                    console.log(data);
                    document.getElementsByClassName('addedimg')[0].innerHTML=data;
                    document.querySelector('.edit-img-material').setAttribute('data-src', file_data['name']);
                },
                error: function (msg) {
                console.log(msg);
                }
            });
       
        }
    }, false);
    
    
    
    
    
    let changeadds = $('.input-add-new');
    for (let changeadd of changeadds) {
        changeadd.addEventListener('change', (event) => {
            var file_data = $(changeadd).prop('files')[0];
            var value = $(changeadd).parent()[0].querySelector('.input-add-new').dataset['id'];
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('id', value);
            console.log(form_data);
            $.ajax({
                url: "../mat/updateaddimg",
                type: "POST",
                data: form_data,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    document.getElementsByClassName('addedimgadd'+value)[0].innerHTML="<div class='preloader'></div>";
                },
                success: function (data) {
                    console.log(data)
                    document.getElementsByClassName('addedimgadd'+value)[0].innerHTML=data;
                    document.querySelector('#add'+value).setAttribute('data-src', file_data['name']);
                },
                error: function (msg) {
                console.log(msg);
                }
            });
    }, false);
    }


    

    editimgBtn = document.querySelector('.edit-img-material');
    editimgBtn.addEventListener('click', (event) => {
        id = editimgBtn.value;
        value = editimgBtn.dataset['src'];
        data = {};
        data['id']=id;
        data['src']=value;
        $.ajax({
            url: "../ajaxEditMaterial/editFirstImg",
            type: "POST",
            data: {data},
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
    }, false);
    deleteimgbtn = document.querySelector('.delete-img-material');
    deleteimgbtn.addEventListener('mouseover', (event) => {
        if ($(deleteimgbtn).parent()[0].querySelector(".addedimg").innerHTML !== '') {
            deleteimgbtn.removeAttribute('disabled');
        } else {
            deleteimgbtn.setAttribute('disabled', '');
            }
        }, false);
    deleteimgbtn.addEventListener('click', (event) => {
        data = {};
        data['id']=deleteimgbtn.value;
        $.ajax({
            url: "../ajaxEditMaterial/deleteFirstImg",
            type: "POST",
            data: {data},
            headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                modal.classList.add('modal_visible');
                $(deleteimgbtn).parent()[0].querySelector(".addedimg").innerHTML= null;
                setTimeout(() => modal.classList.remove('modal_visible'), 2000);
            },
            error: function (msg) {
            console.log(msg);
            }
        });
    },false)
    
    
    
    let deleteaddimgbtns = $('.delete-img-add');
    for(let deleteaddimgbtn of deleteaddimgbtns){
        deleteaddimgbtn.addEventListener('click', (event) => {
            id = deleteaddimgbtn.value
            data = {};
            data['id']= id;
            console.log($(deleteaddimgbtn).parent()[0].innerHTML);
            
            $.ajax({
                url: "../ajaxEditMaterial/deleteImg",
                type: "POST",
                data: {data},
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    modal.classList.add('modal_visible');
                    setTimeout(() => $(deleteaddimgbtn).parent()[0].remove(), 2000);
                    setTimeout(() => modal.classList.remove('modal_visible'), 2000);
                },
                error: function (msg) {
                    console.log(msg)
                }
            });
        },false)
    }
    let adds = document.getElementsByClassName('edit-img-add');
        for (let add of adds) {
            add.addEventListener('click', (event) => {
            id = add.value;
            value = add.dataset['src'];
            data = {};
            data['id']=id;
            data['src']=value;
            $.ajax({
                url: "../ajaxEditMaterial/editImg",
                type: "POST",
                data: {data},
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
        }, false);
    }

    









}, false);