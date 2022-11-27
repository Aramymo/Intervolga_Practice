<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
}
?>
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
    <form method="POST" action="/api/delete_review/">
        <div>
            <label>Review_id:</label>
            <input type="text" name="review_id" value="<?php echo $review[0] ?>" readonly>
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
</body>
</html>