<?php

namespace App;
use App\sqliteconnection;

class SQLiteAdd
{
    public function addReview($username, $rating, $comment)
    {
        //Получение даты оставления отзыва
        $review_date = date("Y-m-d");
        $stmt = sqliteconnection::prepare('INSERT INTO reviews (username,rating,review_date,comment)
                                     VALUES (:username, :rating, :review_date, :comment);');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':review_date', $review_date);
        $stmt->bindParam(':comment', $comment);
        $result = $stmt->execute();
        return $result;
    }
}