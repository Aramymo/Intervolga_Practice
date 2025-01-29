<?php


namespace App;


class SQLiteDelete {
    public function deleteReview(int $id): bool {
        $stmt = sqliteconnection::prepare('DELETE FROM reviews WHERE review_id = :review_id;');
        $stmt->bindParam(':review_id', $id);

        return $stmt->execute();
    }
}