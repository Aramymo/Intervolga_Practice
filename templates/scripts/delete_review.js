function Delete(id){
    var formData ={
        review_id: id,
    };
    console.log(formData);
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
};