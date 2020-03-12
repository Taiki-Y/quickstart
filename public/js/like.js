

$(function(){
    $('.good-button').click(function(){
    $(this).addClass('clicked');
    console.log(this);
    var clicked = document.getElementsByClassName('clicked');
    console.log(clicked);
    
    for (var i = 0; i < clicked.length; i++) {
        clicked[i].textContent ="いいね済み";
        }

    $.ajax({
    type: 'get',
    datatype: 'json',
    url: '/tasks/like/'
    })
    .done(function(data){ //ajaxの通信に成功した場合
    alert("success!");
    console.log(data['status']);
    console.log(data['message']);
    })
    .fail(function(data){ //ajaxの通信に失敗した場合
    alert("error!");
    });
    });
});