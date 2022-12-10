<!DOCTYPE html>
<html lang="ru-en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
    <?php require_once('delete_review_logic.php');?>
</head>
<body>
<h1>Welcome to the feedback page</h1>
<p>Here you can delete a review</p>
<div>
    But now here is nothing to see..Unless.?
    <?php

    foreach ($reviews as $review):
    ?>
    <form method="POST" action="/api/delete/">
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
        <input type="submit" value="Delete review">
    </form>
    <?php endforeach; ?>
</div>
<script> <?php include __DIR__ . '/../scripts/jquery-3.6.1.js'?></script>
<script> <?php include __DIR__ . '/../scripts/delete_review.js'?></script>
</body>
</html>