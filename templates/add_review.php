<!DOCTYPE html>
<html lang="ru-en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
</head>
<body>
<h1>Welcome to the feedback page</h1>
<p>Please give your review in the form below:</p>
<div>
    <form method="POST" action="/api/add_review/">
        <div>
            <label>Username:</label>
            <input type="text" name="username">
        </div>
        <div>
            <label>Rating:</label>
            <input type="radio" name="rating" value="1">
            <input type="radio" name="rating" value="2">
            <input type="radio" name="rating" value="3">
            <input type="radio" name="rating" value="4">
            <input type="radio" name="rating" value="5">
            <input type="radio" name="rating" value="6">
            <input type="radio" name="rating" value="7">
            <input type="radio" name="rating" value="8">
            <input type="radio" name="rating" value="9">
            <input type="radio" name="rating" value="10">
        </div>
        <div>
            <label>Comment</label>
            <input type="text" name="comment">
        </div>
        <input type="submit" value="Add review">
    </form>
</div>
</body>
</html>