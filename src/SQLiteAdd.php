<?php

namespace App;

class SQLiteAdd
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addReview($username, $rating, $comment)
    {
        $review_date = date("Y-m-d");
        $stmt = $this->pdo->prepare('INSERT INTO reviews (username,rating,review_date,comment)
                                     VALUES (:username, :rating, :review_date, :comment);');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':review_date', $review_date);
        $stmt->bindParam(':comment', $comment);
        $result = $stmt->execute();
        return $result;
    }
}