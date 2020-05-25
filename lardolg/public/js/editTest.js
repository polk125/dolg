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
        $.ajax({
            url: "../ajaxEditTest/editName",
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
        $.ajax({
            url: "../ajaxEditTest/editTheme",
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
        $.ajax({
            url: "../ajaxEditTest/editLesson",
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

    let questions = document.getElementsByClassName('edit-new-question');
                    for (let question of questions) {
                        let href = question.parentNode.getElementsByClassName('new-question')[0];
                        let value = href.value;
                        question.parentNode.getElementsByClassName('new-question')[0]
                            .addEventListener('keyup', (event) => {
                                if (event.target.value !== value) {
                                    question.removeAttribute('disabled');
                                } else {
                                    question.setAttribute('disabled', '');
                                }
                            }, false);
                            question.addEventListener('click', (event) => {
                            let id = question.value;
                            let value = event.target.parentNode.getElementsByClassName('new-question')[0].value;
                            data = {};
                            data['id']=id;
                            data['new_question']=value;
                            $.ajax({
                                url: "../ajaxEditTest/editQuestion",
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

                    let answers = document.getElementsByClassName('edit-new-answer');
                    for (let answer of answers) {
                        let check = answer.parentNode.getElementsByClassName('new-correct')[0];
                        let correct = check.checked;
                        let href = answer.parentNode.getElementsByClassName('new-answer')[0];
                        let value = href.value;
                            answer.addEventListener('click', (event) => {
                            let id = answer.value;
                            let value = event.target.parentNode.getElementsByClassName('new-answer')[0].value;
                            let check = answer.parentNode.getElementsByClassName('new-correct')[0];
                            let correct = check.checked;
                            if(correct==false){
                                correct = 0;
                            }else{
                                correct = 1;
                            }
                            data = {};
                            data['id']=id;
                            data['new_answer']=value;
                            data['new_correct']=correct;
                            $.ajax({
                                url: "../ajaxEditTest/editAnswer",
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



















                    






document.addEventListener('change', (event) => {
        if (event.target.classList.contains('input-new')) {

            var file_data = $('.input-new').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: "../test/updateimg",
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
                    document.getElementsByClassName('addedimg')[0].innerHTML=data;
                    document.querySelector('.delete-img-test').removeAttribute('disabled');
                    document.querySelector('.edit-img-test').setAttribute('data-src', file_data['name']);
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
            $.ajax({
                url: "../test/updateaddimg",
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
                    document.getElementsByClassName('addedimgadd'+value)[0].innerHTML=data;
                    $(changeadd).parent()[0].querySelector('.delete-img-add').removeAttribute('disabled');
                    document.querySelector('#add'+value).setAttribute('data-src', file_data['name']);
                },
                error: function (msg) {
                console.log(msg);
                }
            });
       
        }, false)
    }

    let changesans = $('.input-ans');
    for (let changeans  of changesans ) {
        changeans.addEventListener('change', (event) => {
            var file_data = $(changeans).prop('files')[0];
            var value = $(changeans).parent()[0].querySelector('.input-ans').dataset['id'];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: "../test/updateanswerimg",
                type: "POST",
                data: form_data,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    document.getElementsByClassName('addansimg'+value)[0].innerHTML="<div class='preloader'></div>";
                },
                success: function (data) {
                    document.getElementsByClassName('addansimg'+value)[0].innerHTML=data;
                    $(changeans).parent()[0].querySelector('.delete-img-ans').removeAttribute('disabled');
                    document.querySelector('#addans'+value).setAttribute('data-src', file_data['name']);
                },
                error: function (msg) {
                console.log(msg);
                }
            });
        },false)
        }

    editimgBtn = document.querySelector('.edit-img-test');
    editimgBtn.addEventListener('click', (event) => {
        id = editimgBtn.value;
        value = editimgBtn.dataset['src'];
        data = {};
        data['id']=id;
        data['src']=value;
        $.ajax({
            url: "../ajaxEditTest/editFirstImg",
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
    deleteimgbtn = document.querySelector('.delete-img-test');
    if ($(deleteimgbtn).parent()[0].querySelector(".addedimg").innerHTML !== '') {
        deleteimgbtn.removeAttribute('disabled');
    } else {
        deleteimgbtn.setAttribute('disabled', '');
        }
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
            url: "../ajaxEditTest/deleteFirstImg",
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


    let editaddimgBtns = $('.edit-img-add');
    for (let editaddimgBtn of editaddimgBtns) {
    editaddimgBtn.addEventListener('click', (event) => {
        
     
        id = editaddimgBtn.value;
        value = editaddimgBtn.dataset['src'];
        data = {};
        data['id']=id;
        data['src']=value;
        $.ajax({
            url: "../ajaxEditTest/editImg",
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
    let deleteaddimgbtns = $('.delete-img-add');
    for(let deleteaddimgbtn of deleteaddimgbtns){
        if (document.getElementsByClassName('addedimgadd'+deleteaddimgbtn.value)[0].innerHTML !== '') {
            deleteaddimgbtn.removeAttribute('disabled');
        } else {
            deleteaddimgbtn.setAttribute('disabled', '');
            }
        deleteaddimgbtn.addEventListener('mouseover', (event) => {
            if (document.getElementsByClassName('addedimgadd'+deleteaddimgbtn.value)[0].innerHTML !== '') {
                deleteaddimgbtn.removeAttribute('disabled');
            } else {
                deleteaddimgbtn.setAttribute('disabled', '');
                }
            }, false);
        deleteaddimgbtn.addEventListener('click', (event) => {
            id = deleteaddimgbtn.value
            data = {};
            data['id']= id;
            $.ajax({
                url: "../ajaxEditTest/deleteImg",
                type: "POST",
                data: {data},
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    modal.classList.add('modal_visible');
                    document.getElementsByClassName('addedimgadd'+id)[0].innerHTML=data;
                    setTimeout(() => modal.classList.remove('modal_visible'), 2000);
                },
                error: function (msg) {
                    console.log(msg)
                }
            });
        },false)
    }

    let editansimgs = $('.edit-img-ans');
    for (let editansimg of editansimgs) {
        editansimg.addEventListener('click', (event) => {
        id = editansimg.value;
        value = editansimg.dataset['src'];
        data = {};
        data['id']=id;
        data['src']=value;
        $.ajax({
            url: "../ajaxEditTest/editAnsImg",
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
    
    let deleteansimgs = $('.delete-img-ans');
    for (let deleteansimg of deleteansimgs) {
        if (document.getElementsByClassName('addansimg'+deleteansimg.value)[0].innerHTML !== '') {
            deleteansimg.removeAttribute('disabled');
        } else {
            deleteansimg.setAttribute('disabled', '');
            }
        deleteansimg.addEventListener('mouseover', (event) => {
            if (document.getElementsByClassName('addansimg'+deleteansimg.value)[0].innerHTML !== '') {
                deleteansimg.removeAttribute('disabled');
            } else {
                deleteansimg.setAttribute('disabled', '');
                }
            }, false);
        deleteansimg.addEventListener('click', (event) => {
        id = deleteansimg.value;
        data = {};
        data['id']=id;
        $.ajax({
            url: "../ajaxEditTest/deleteAnsImg",
            type: "POST",
            data: {data},
            headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                
                modal.classList.add('modal_visible');
                document.getElementsByClassName('addansimg'+id)[0].innerHTML=null;
                setTimeout(() => modal.classList.remove('modal_visible'), 2000);
            },
            error: function (msg) {
            console.log(msg);
            }
        });
    }, false);
    }















    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('del-new')) {
            let del = confirm('Удалить?');
            if (!del) return;
            let id = event.target.value;
            $.ajax({
                url: "../ajaxEditTest/delete/"+id,
                type: "GET",
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    document.getElementsByClassName('new-lesson')[0].value=data;
                    modal.classList.add('modal_visible');
                    setTimeout(() => modal.classList.remove('modal_visible'), 2000);
                    document.location.href="../tests";
                },
                error: function (msg) {
                console.log(msg);
                }
            });
        }
    }, false);
}, false);