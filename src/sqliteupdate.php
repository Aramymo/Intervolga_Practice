<?php

namespace App;
use App\sqliteconnection;

class sqliteupdate
{
    public function updateReview($id, $reviewData)
    {
        // Подготовка SQL-запроса для обновления отзыва
        $stmt = sqliteconnection::prepare('UPDATE reviews 
                                            SET username = :username,
                                                email = :email, 
                                                rating = :rating, 
                                                reviewed_product = :reviewed_product, 
                                                satisfaction = :satisfaction, 
                                                comment = :comment 
                                            WHERE review_id = :review_id;');
        // Привязка параметров
        $stmt->bindParam(':review_id', $id);
        $stmt->bindParam(':username', $reviewData['username']);
        $stmt->bindParam(':email', $reviewData['email']);
        $stmt->bindParam(':rating', $reviewData['rating']);
        $stmt->bindParam(':reviewed_product', $reviewData['reviewed_product']);
        $stmt->bindParam(':satisfaction', $reviewData['satisfaction']);
        $stmt->bindParam(':comment', $reviewData['comment']);

        return $stmt->execute();
    }
}