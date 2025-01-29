<?php


namespace App;


class sqlitequery {

    public function getReviewById(int $review_id): array {
        $stmt = sqliteconnection::prepare('SELECT * FROM reviews
                                     WHERE review_id = :review_id;');
        $stmt->execute([':review_id' => $review_id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $row;
    }

    public function getAllReviews(int $page): array {
        $stmt = sqliteconnection::prepare('SELECT COUNT(*) FROM reviews');
        $stmt->execute();
        $number_of_rows=$stmt->fetchColumn();
        $results_per_page = 30;
        $number_of_pages = ceil($number_of_rows/$results_per_page);
        $page = ceil($page);

        if ($page <= 0) {
            $page = 1;
        } else if ($page > $number_of_pages) {
            $page = $number_of_pages;
        }

        $page_first_result = ($page-1) * $results_per_page;
        $stmt = sqliteconnection::prepare('SELECT * FROM reviews
                                     ORDER BY review_date DESC, review_id DESC LIMIT :page_first_result, :results_per_page;');
        $stmt->execute(array(':page_first_result' => $page_first_result, ':results_per_page' => $results_per_page));
        $reviews = array();

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $row['number_of_pages'] = $number_of_pages;
            $reviews[] = $row;
        }

        return $reviews;
    }
    public function getAllWithoutPages(): array {
        $stmt = sqliteconnection::prepare('SELECT * FROM reviews ORDER BY review_date DESC, review_id DESC;');
        $stmt->execute();

        return $stmt->fetchAll();
    }
}