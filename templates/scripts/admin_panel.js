function deleteRewiew(id){
    if (confirm('Подтвердите удаление') === true) {
        var formData = {
            review_id: id,
        };

        $.ajax({
            url : "http://localhost:8888/api/delete_review/",
            type: "POST",
            data: formData,
            encode: true,
            success: function(){
                window.location.reload();
            }
        });
    }
}

function redirectToIdForm(id) {
    window.location.href = '/admin_panel/update/' + id;
}