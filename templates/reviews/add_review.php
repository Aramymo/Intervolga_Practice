<!DOCTYPE html>
<html lang="ru-en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Feedback</title>
    <style>
        <?php include_once __DIR__ . "/../css/reviews.css" ?>
        <?php include_once __DIR__ . "/../css/stars.css" ?>
    </style>
</head>
<body>
    <?php include_once __DIR__ . "/../header.php"?>
<div>
    <?php include_once __DIR__ . "/form_template.php"?>
</div>
<script> <?php include_once __DIR__ . '/../scripts/jquery-3.6.1.js'?></script>
<script> <?php include_once __DIR__ . '/../scripts/send_review.js'?></script>
    <script> <?php include_once __DIR__ . '/../scripts/stars.js'?></script>
</body>
</html>