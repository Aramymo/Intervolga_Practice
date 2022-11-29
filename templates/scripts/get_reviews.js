// console.log("TESTING");
// $(document).ready(function() {
//     $('.page_link').on('click', function (e) {
//
//         //Отменяем стандартное поведение ссылок
//         e.preventDefault();
//
//         //Получаем значение ссылки
//         let page = $(this).attr('href');
//
//         // При клике на кнопку назад, добавляем класс "active" текущей ссылке
//         // $(this).closest('ul').find('li').removeClass('active');
//         // $(this).parent().addClass('active');
//
//         // Выполняем ajax запрос
//         $.ajax({
//             url: '/api/feedbacks/page',
//             type: 'POST',
//             success: function () {
//                 //$('.note').html(data);
//                 console.log('aboba');
//             },
//             error: function (){
//                 console.log('akfoakfoaskfokf');
//             }
//         });
//     });
// });
// $.ajax({
//     url: "api/feedbacks/page=1",
//     type: "POST",
//     cache: false,
//     success: function(data){
//         alert(data);
//         $().html(data);
//     }
// });

// $(document).ready(function(){
//
// })
// function showReviews(str) {
//     if (str == "") {
//         //document.getElementById("txtHint").innerHTML = "";
//         return;
//     } else {
//         var xmlhttp = new XMLHttpRequest();
//         xmlhttp.onreadystatechange = function() {
//             if (this.readyState == 4 && this.status == 200) {
//                 document.getElementById("aboba").innerHTML = this.responseText;
//             }
//         };
//         xmlhttp.open("GET","/api/feedbacks/page="+str,true);
//         xmlhttp.send();
//     }
// }

// $.ajax({
//     url: "/api/feedbacks/page=1",
//     type: "GET",
//     cache: false,
//     success: function (data) {
//         alert("done");
//         console.log('aboba');
//         $().html(data);
//     }
// })

// $(document).ready(function(){
//     console.log("aksmflaksf");
//         $.ajax({
//         url: "/api/feedbacks/page=1",
//         type: "GET",
//         context: document.body,
//         cache: false,
//         success: function (data) {
//             alert("done");
//             console.log('aboba');
//             $().html(data);
//         }
//     })
//     // console.log()
//     // var xmlhttp = new XMLHttpRequest();
//     // xmlhttp.open("GET","/api/feedbacks/page="+str,true);
//     // xmlhttp.send();
//     // console.log(this.response);
// });
function showUser(str) {
    $.ajax({
        url: "/api/feedbacks/page=1",
        type: "GET",
        context: document.body,
        cache: false,
        success: function (data) {
            console.log(document.body);
        }
    });
    // if (str == "") {
    //     document.getElementById("txtHint").innerHTML = "";
    //     console.log(this.response);
    //     return;
    // } else {
    //     var xmlhttp = new XMLHttpRequest();
    //     xmlhttp.onreadystatechange = function() {
    //         if (this.readyState == 4 && this.status == 200) {
    //             document.getElementById("aboba").innerHTML = this.response;
    //             console.log(this.response);
    //         }
    //     };
    //     xmlhttp.open("GET","/api/feedbacks/page="+str,true);
    //     xmlhttp.send();
    // }
}