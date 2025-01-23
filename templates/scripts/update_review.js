$("form").submit(function(event){
    const formData ={
        review_id: $("#review_id").val(),
        username: $("#username").val(),
        rating: $('input[name=rating]:checked').val(),
        email: $("#email").val(),
        reviewed_product: $("#reviewed_product").val(),
        satisfaction: $('#satisfaction').is(':checked'),
        comment: $("#comment").val(),
    };

    $.ajax({
        url : "http://localhost:8888/api/update_review/",
        type: "POST",
        data: formData,
        encode: true,
        success: function(response){
            window.location.href = '/admin_panel/';
        }
    });
    event.preventDefault();
});