<?php

namespace App;
use App\sqliteconnection;

class sqliteupdate
{
    public function updateReview($id, $username, $rating, $comment)
    {
        // Подготовка SQL-запроса для обновления отзыва
        $stmt = sqliteconnection::prepare('UPDATE reviews 
                                            SET username = :username, 
                                                rating = :rating, 
                                                comment = :comment 
                                            WHERE review_id = :review_id;');
        // Привязка параметров
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':review_id', $id);

        // Выполнение запроса
        $result = $stmt->execute();
        return $result;
    }
}