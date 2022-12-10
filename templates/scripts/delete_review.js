function Delete(id){
    //Запись айди отзыва
    var formData ={
        review_id: id,
    };
    //Выполнение пост-запроса
    $.ajax({
        url : "http://localhost:8888/api/delete_review/",
        type: "POST",
        data: formData,
        encode: true,
        success: function(){
            //перезагрузка страницы
            window.location.reload();
        }
    });
};