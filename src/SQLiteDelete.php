<?php

namespace App;

class SQLiteDelete
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function deleteReview($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM reviews WHERE review_id = :review_id;');
        $stmt->bindParam(':review_id', $id);
        $result = $stmt->execute();
        return $result;
    }
}