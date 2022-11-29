$("form").submit(function(event){
    document.getElementById('error-div').innerHTML = '';
    var formData ={
        username: $("#username").val(),
        password: $("#password").val(),
    };
    $.ajax({
        url : "http://localhost:8888/login",
        type: "POST",
        dataType: "json",
        data: formData,
        encode: true,
    }).done(function(response){
        for(var i=0; i<response.length; i++)
        {
            document.getElementById('error-div').innerHTML += "<p>" + response[i] + "</p>";
        }
    });
    event.preventDefault();
});