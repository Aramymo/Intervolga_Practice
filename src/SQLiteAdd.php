<?php

namespace App;
use App\sqliteconnection;

class SQLiteAdd
{
    public function addReview(array $reviewData): bool {
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

        $stmt->bindParam(':username', $reviewData['username']);
        $stmt->bindParam(':email', $reviewData['email']);
        $stmt->bindParam(':review_date', $reviewDate);
        $stmt->bindParam(':rating', $reviewData['rating']);
        $stmt->bindParam(':reviewed_product', $reviewData['reviewed_product']);
        $stmt->bindParam(':satisfaction', $reviewData['satisfaction']);
        $stmt->bindParam(':comment', $reviewData['comment']);

        return $stmt->execute();
    }
}