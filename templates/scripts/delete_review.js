$("form").submit(function(event){
    var formData ={
        review_id: $("#review_id").val(),
    };
    $.ajax({
        url : "http://localhost:8888/api/delete_review/",
        type: "POST",
        data: formData,
        encode: true,
        success: function(){
            window.location.reload();
        },
        error: function(){
            console.log($("#review_id").val());
        }
    });
    event.preventDefault();
});