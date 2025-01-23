<?php

namespace App;
use App\sqliteconnection;

class SQLiteAdd
{
    public function addReview(array $reveiwData /*$username, $rating, $comment*/): bool
    {
        //Получение даты оставления отзыва
        $reviewDate = date("Y-m-d");
        $stmt = sqliteconnection::prepare('INSERT INTO reviews (
                     username,
                     email,
                     review_date,
                     rating,
                     reviewed_product,
                     satisfaction,
                     comment)
            VALUES (
                    :username, 
                    :email,
                    :review_date, 
                    :rating, 
                    :reviewed_product,
                    :satisfaction,
                    :comment);'
        );

        $stmt->bindParam(':username', $reveiwData['username']);
        $stmt->bindParam(':email', $reveiwData['email']);
        $stmt->bindParam(':review_date', $reviewDate);
        $stmt->bindParam(':rating', $reveiwData['rating']);
        $stmt->bindParam(':reviewed_product', $reveiwData['reviewed_product']);
        $stmt->bindParam(':satisfaction', $reveiwData['satisfaction']);
        $stmt->bindParam(':comment', $reveiwData['comment']);

        return $stmt->execute();
    }
}