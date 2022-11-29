<?php

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
}
//$json_data = $results;
//$reviews = json_decode($json_data,true);
?>
<!DOCTYPE html>
<html lang="ru-en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Feedback</title>
    <style>
        <?php include "css/reviews.css" ?>
    </style>
</head>
<body>
<div class="sticky-header" id="sticky_header">
    <a href="/" class="home_button">Go Home</a>
    <div>
        <ul id="navlist">
            <li class="nav-li"><a href="/login"><button class="btn">Log in</button></a></li>
        </ul>
    </div>
</div>
<br>
<div id = 'pages' class = "centered_text">
</div>
<div id = "reviews"">

</div>
<!--data-->
</div>
<div class="centered_text">
<!--    pages-->
    <script> <?php include"scripts/stickyHeader.js"?></script>
    <script> <?php include "scripts/jquery-3.6.1.js"?></script>
    <script>
        document.onload = showUser(1);
            function showUser(str)
            {
                $.ajax({
                    url: "http://localhost:8888/api/feedbacks/page="+str,
                    type: "GET",
                    dataType: "json",
                    cache: false,
                    success: function (response) {
                        document.getElementById('reviews').innerHTML = '';
                        document.getElementById('pages').innerHTML = '';
                        for (var num_of_pages = 1; num_of_pages < response[0]['number_of_pages'] + 1; num_of_pages++)
                        {
                            document.getElementById("pages").innerHTML += "<a id='" + num_of_pages +
                                "' class = 'page_link' onclick='showUser(this.id)'>" + num_of_pages + "</a>";
                        }
                        for (var res in response)
                        { //for each review
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
                        // if(response['success']==0)
                        // {
                        //     console.log('TI DAUN');
                        //     return;
                        // }
                        // var res = response['results'];
                        // $.each(res, function(i,val){
                        //     console.log("WHY");
                        //     // var newline = '';
                        //     // newline +='<div>' + val + '</div>';
                        // })
                    }
                })
            };</script>
</div>
</body>
</html>