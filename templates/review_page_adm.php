<!DOCTYPE html>
<html lang="ru-en">
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <title>AdminPage</title>
        <style>
            <?php include_once (__DIR__ . '/css/reviews.css')?>
        </style>
    </head>
    <body>
        <?php include_once (__DIR__ . '/reviews/display_reviews.php')?>

        <script> <?php include_once (__DIR__ . '/scripts/admin_panel.js')?></script>
    </body>
</html>