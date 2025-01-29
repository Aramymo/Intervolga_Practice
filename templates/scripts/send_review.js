$("form").submit(function(event){
    const formData = {
        username: $("#username").val(),
        rating: $('input[name=rating]:checked').val(),
        email: $("#email").val(),
        reviewed_product: $("#reviewed_product").val(),
        satisfaction: $('#satisfaction').is(':checked'),
        comment: $("#comment").val(),
    };

    if (formData.rating === undefined) {
        document.getElementById('review_message').innerHTML = '';
        document.getElementById("review_message").innerHTML += "<div class='review_send_status_error centered_text'>Пожалуйста поставьте оценку</div>";
        event.preventDefault();

        return;
    }

    $.ajax({
        url : "http://localhost:8888/api/add_review/",
        type: "POST",
        dataType: "json",
        data: formData,
        encode: true,
        success: function(){
            window.location.href = '/feedbacks/';
        },
        error: function(){
            document.getElementById('review_message').innerHTML = '';
            document.getElementById("review_message").innerHTML += "<div class='review_send_status_error centered_text'>Ошибка в отправлении отзыва</div>";
        }
    });
    event.preventDefault();
});