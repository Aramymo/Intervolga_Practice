$("form").submit(function(event){
    //Запись всех данных, полученных из формы
    var formData ={
        username: $("#username").val(),
        rating: $('input[name=rating]:checked').val(),
        comment: $("#comment").val(),
    };
    $.ajax({
        //выполнение пост-запроса
        url : "http://localhost:8888/api/add_review/",
        type: "POST",
        dataType: "json",
        data: formData,
        encode: true,
        success: function(){
            //отображение сообщения об успехе
            document.getElementById('review_message').innerHTML = '';
            document.getElementById("review_message").innerHTML += "<div class='review_send_status_success centered_text'>Отзыв успешно отправлен</div>";
        },
        error: function(){
            //отображение сообщения об ошибке
            document.getElementById('review_message').innerHTML = '';
            document.getElementById("review_message").innerHTML += "<div class='review_send_status_error centered_text'>Ошибка в отправлении отзыва</div>";
        }
    });
    event.preventDefault();
});