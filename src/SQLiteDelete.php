<?php

namespace App;
use App\SQLiteConnection;

class SQLiteDelete
{
    public function deleteReview($id)
    {
        $stmt = SQLiteConnection::prepare('DELETE FROM reviews WHERE review_id = :review_id;');
        $stmt->bindParam(':review_id', $id);
        $result = $stmt->execute();
        return $result;
    }
}