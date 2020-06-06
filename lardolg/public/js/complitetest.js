window.addEventListener('load', () => {
    let changeadds = document.getElementsByClassName('answer_type');
    for (let changeadd of changeadds) {
        changeadd.addEventListener('change', (event) => { 
            if (changeadd.checked) {
                var value = changeadd.dataset['type'];
                    var pass = changeadd.dataset['test'];
                    data = {};
                    data['id']=value;
                    data['pass']=pass;
                    $.ajax({
                        url: "../test/addanswer",
                        type: "POST",
                        data: {data},
                        headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                        },
                        error: function (msg) {
                        console.log(msg);
                        }
                    });
                }
                else {
                    var value = changeadd.dataset['type'];
                    var pass = changeadd.dataset['test'];
                    data = {};
                    data['id']=value;
                    data['pass']=pass;
                    $.ajax({
                        url: "../test/deleteanswer",
                        type: "POST",
                        data: {data},
                        headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            console.log(data);
                        },
                        error: function (msg) {
                        console.log(msg);
                        }
                    });
                }
    }, false);
    }

    let endtest = document.querySelector('.end-test');
    endtest.addEventListener('click', (event) => { 
            var value = endtest.value;
            data = {};
            data['id']=value;
                $.ajax({
                    url: "../test/endtest",
                    type: "POST",
                    data: {data},
                    headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        window.location.replace("../start/"+value);
                    },
                    error: function (msg) {
                    console.log(msg);
                    }
                });
            },false);
    // Set the date we're counting down to
var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();
var counthours = document.querySelector('.timer').dataset['hours'];
var counthminutes = document.querySelector('.timer').dataset['minutes'];
var timer = parseInt(document.querySelector('.timer').dataset['started'], 10);
if (timer) {
    then = timer + counthours*3600000 + counthminutes*60000;
}else{
    clearInterval(countdownfunction);
    let endtest = document.querySelector('.end-test');
        var value = endtest.value;
        data = {};
        data['id'] = value;
        data['time']=new Date().getTime();
            $.ajax({
                url: "../test/starttest",
                type: "POST",
                data: {data},
                headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                },
                error: function (msg) {
                console.log(msg);
                }
            });
            var then = new Date().getTime() + counthours*3600000 + counthminutes*60000;
}



// Update the count down every 1 second
var countdownfunction = setInterval(function() {
    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = then - now;
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = hours + "ч "
    + minutes + "м " + seconds + "c ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(countdownfunction);
        let endtest = document.querySelector('.end-test');
            var value = endtest.value;
            data = {};
            data['id']=value;
                $.ajax({
                    url: "../test/endtest",
                    type: "POST",
                    data: {data},
                    headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        window.location.replace("../start/"+value);
                    },
                    error: function (msg) {
                    console.log(msg);
                    }
                });
    }
}, 1000);
}, false);