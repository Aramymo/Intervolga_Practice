<?php

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
}
$json_data = $results;
$reviews = json_decode($json_data,true);
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
            <li class="nav-li"><?php if(!isset($_SESSION['username'])){?><a href="/login"><button class="btn">Log in</button></a><?php }else{ echo $_SESSION['username'];}?></li>
        </ul>
    </div>
</div>
<br>
<button value="1" onclick="showUser(this.value)">CALL AJAX</button>
<button value="2" onclick="showUser(this.value)">CALL AJAX</button>
<div id="txtHint"><b>Person info will be listed here...</b></div>
<div class="centered_text">
<?php //for($page = 1; $page <= $_SESSION['pages'];$page++){ ?>
<!--    <a value="--><?php //echo $page ?><!--" class="page_link" onclick="showReviews(this.value)">--><?php //echo $page ?><!--</a>-->
<?php //} ?>
    <?php for($page = 1; $page <= $_SESSION['pages'];$page++){ ?>
        <a href="page=<?php echo $page ?>" class="page_link"><?php echo $page ?></a>
    <?php } ?>
</div>
<div id = "aboba">

</div>
<?php foreach ($reviews as $review) : ?>
    <div class="row review_block">
        <div class="col-md-4centered_text">
            <h3><?php echo $review['username']?></h3>
        </div>
        <div class="col-md-8">
            <h5><?php echo $review['rating']?>/10</h5>
            <p><?php echo $review['comment']?></p>
        </div>
    </div>
<?php endforeach ?>
</div>
<div class="centered_text">
    <?php for($page = 1; $page <= $_SESSION['pages'];$page++){ ?>
        <a href="page=<?php echo $page ?>" class="page_link"><?php echo $page ?></a>
    <?php } ?>
    <script> <?php include"scripts/stickyHeader.js"?></script>
    <script> <?php include "scripts/jquery-3.6.1.js"?></script>
    <script><?php include"scripts/get_reviews.js"?></script>
</div>
</body>
</html>