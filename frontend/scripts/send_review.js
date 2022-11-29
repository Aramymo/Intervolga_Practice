$("form").submit(function(event){
    var formData ={
        username: $("#username").val(),
        rating: $('#rating').val(),
        comment: $("#comment").val(),
    };
    $.ajax({
        url : "http://localhost:8888/api/add_review/",
        type: "POST",
        dataType: "json",
        data: formData,
        encode: true,
        success: function(response){
            console.log("response");
        },
        error: function(){
            console.log("aboba");
        }
    }).done(function(response){
        console.log("PROVERYAI");
    });
    event.preventDefault();
});