<?php

namespace App;
use App\sqliteconnection;

class SQLiteDelete
{
    public function deleteReview($id)
    {
        $stmt = sqliteconnection::prepare('DELETE FROM reviews WHERE review_id = :review_id;');
        $stmt->bindParam(':review_id', $id);
        $result = $stmt->execute();
        return $result;
    }
}