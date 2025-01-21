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
    <?php include_once "header.php"?>
<br>
    <div id = 'pages' class = "centered_text"></div>
    <div id = "reviews"></div>


<!--data-->


    <script> <?php include('scripts/jquery-3.6.1.js')?></script>
    <script> <?php include('scripts/get_reviews.js')?></script>
</body>
</html>