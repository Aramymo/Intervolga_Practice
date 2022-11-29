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
    <a href="reviews.php" class="home_button">Go Home</a>
    <div>
        <ul id="navlist">
            <li class="nav-li"><a href="regandlog/login.php"><button class="btn">Log in</button></a></li>
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
    <script src="scripts/stickyHeader.js"></script>
    <script src="scripts/jquery-3.6.1.js"></script>
    <script src="scripts/get_reviews.js"></script>
</div>
</body>
</html>