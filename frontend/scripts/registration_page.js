$("form").submit(function(event){
    document.getElementById('error-div').innerHTML = '';
    var formData ={
        username: $("#username").val(),
        user_email: $('#user_email').val(),
        password1: $("#password1").val(),
        password2: $("#password2").val(),
    };
    $.ajax({
        url : "http://localhost:8888/registration",
        type: "POST",
        dataType: "json",
        data: formData,
        encode: true,
        error: function(){
            console.log("aboba");
        }
    }).done(function(response){
        for(var i=0; i<response.length; i++)
        {
            document.getElementById('error-div').innerHTML += "<p>" + response[i] + "</p>";
        }
    });
    event.preventDefault();
});