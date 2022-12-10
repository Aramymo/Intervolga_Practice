<!DOCTYPE html>
<html lang="ru-en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
</head>
<body>
<h1>Удаление отзывов</h1>
<p>Отзывы удаляются безвозвратно</p>
<div>
    <?php
    $i = 1;
    foreach ($data as $review):
    ?>
    <div id="delete_div">
        <div>
            <label>Review_id:</label>
            <input type="text" name="review_id" value="<?php echo $review[0] ?>" id = "review_id" readonly>
        </div>
        <div>
            <tr>
                <td><?php echo $review[1] ?></td>
                <td><?php echo $review[2] ?></td>
                <td><?php echo $review[3] ?></td>
                <td><?php echo $review[4] ?></td>
            </tr>
        </div>
        <input type="button" value="Delete" onclick="Delete(<?php echo $review[0] ?>)">
    </div>
    <?php endforeach; ?>
</div>
<script> <?php include __DIR__ . '/../scripts/jquery-3.6.1.js'?></script>
<script> <?php include __DIR__ . '/../scripts/delete_review.js'?></script>
</body>
</html>