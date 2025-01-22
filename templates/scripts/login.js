$("form").submit(function(event){
    var formData ={
        username: $("#username").val(),
        password: $("#password").val(),
        redirect_uri: new URLSearchParams(window.location.search).get('redirect'),
    };

    const responseData = $.ajax({
        url: "http://localhost:8888/api/authorize/",
        type: "POST",
        data: formData,
        encode: true,
        success: function () {
            const redirectUri = responseData.getResponseHeader("Location");
            window.location.href = redirectUri;
        },
        error: function (xhr) {
            if (xhr.status === 401) {
                $('#review_message').text('Неверные учетные данные.');
            } else {
                $('#review_message').text('Произошла ошибка. Попробуйте еще раз.');
            }
        },
    });
    event.preventDefault();
});