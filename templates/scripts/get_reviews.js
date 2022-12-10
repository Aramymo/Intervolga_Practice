//Выполнение функции при загрузке страницы
document.onload = showUser(1);
function showUser(str)
{
    //Выполнение гет-запроса к контроллеру
    $.ajax({
        url: "http://localhost:8888/api/feedbacks/page="+str,
        type: "GET",
        dataType: "json",
        cache: false,
        success: function (response) {
            document.getElementById('reviews').innerHTML = '';
            document.getElementById('pages').innerHTML = '';
            //отображение страниц, их количество возвращается в response вместе с отзывами
            for (var num_of_pages = 1; num_of_pages < response[0]['number_of_pages'] + 1; num_of_pages++)
            {
                document.getElementById("pages").innerHTML += "<a id='" + num_of_pages +
                    "' class = 'page_link' onclick='showUser(this.id)'>" + num_of_pages + "</a>";
            }
            for (var res in response)
            { //for each review
                //Запись отзывов
                document.getElementById('reviews').innerHTML += "<div class='row review_block'>" +
                    "<div class='col-md-4centered_text'>" +
                    "<h3>"+ response[res]['username'] + "</h3>" +
                    "</div>" +
                    "<div class='col-md-8'>" +
                    "<h5>"+ response[res]['rating'] + "/10</h5>" +
                    "<p>"+ response[res]['comment'] + "</p>" +
                    "</div>" +
                    "</div>";
                console.log(res, response[res]['username']);
            }
        }
    })
};