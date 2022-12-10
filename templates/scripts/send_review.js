$("form").submit(function(event){
    var formData ={
        username: $("#username").val(),
        rating: $('input[name=rating]:checked').val(),
        comment: $("#comment").val(),
    };
    console.log(formData);
    $.ajax({
        url : "http://localhost:8888/api/add_review/",
        type: "POST",
        dataType: "json",
        data: formData,
        encode: true,
        success: function(){
            document.getElementById('review_message').innerHTML = '';
            document.getElementById("review_message").innerHTML += "<div class='review_send_status_success centered_text'>Отзыв успешно отправлен</div>";
        },
        error: function(){
            document.getElementById('review_message').innerHTML = '';
            document.getElementById("review_message").innerHTML += "<div class='review_send_status_error centered_text'>Ошибка в отправлении отзыва</div>";
        }
    });
    event.preventDefault();
});