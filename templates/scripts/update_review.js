$("form").submit(function(event){
    var formData ={
        review_id: $("input[name=review_id]").val(),
        username: $("#username").val(),
        rating: $('input[name=rating]:checked').val(),
        comment: $("#comment").val(),
    };
    console.log(formData.review_id);
    $.ajax({
        url : "http://localhost:8888/api/update_review/",
        type: "POST",
        data: formData,
        encode: true,
        success: function(){
            window.location.href = '/admin_panel/';
        }
    });
    event.preventDefault();
});