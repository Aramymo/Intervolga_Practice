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
    <a href="/" class="home_button">На главную</a>
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
<!--    <script src="scripts/stickyHeader.js"></script>-->
    <script> <?php include('scripts/stickyHeader.js')?></script>
    <script> <?php include('scripts/jquery-3.6.1.js')?></script>
    <script> <?php include('scripts/get_reviews.js')?></script>
<!--    <script src="scripts/jquery-3.6.1.js"></script>-->
<!--    <script src="scripts/get_reviews.js"></script>-->
</div>
</body>
</html>