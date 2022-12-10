<?php
namespace App;

class SQLiteQuery{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getReviewById($review_id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM reviews
                                     WHERE review_id = :review_id;');

        $stmt->execute([':review_id' => $review_id]);

        // for storing reviews
        $review = [];
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $review[] = [
            'review_id' => $row['review_id'],
            'username' => $row['username'],
            'rating' => $row['rating'],
            'review_date' => $row['review_date'],
            'comment' => $row['comment'],
        ];

        return $review;
//        return json_encode($reviews,JSON_UNESCAPED_UNICODE);
    }
    public function getAllReviews($page)
    {
        $number_of_rows = $this->pdo->query('SELECT COUNT(*) FROM reviews')->fetchColumn();
        $results_per_page = 20;
        $number_of_pages = ceil($number_of_rows/$results_per_page);
        if ($page <= 0) {
            $page = 1;
        }
        if ($page > $number_of_pages)
        {
            $page = $number_of_pages;
        }
        $page_first_result = ($page-1) * $results_per_page;
        $stmt = $this->pdo->prepare('SELECT * FROM reviews
                                     ORDER BY review_date DESC, review_id DESC LIMIT :page_first_result, :results_per_page;');
        $stmt->execute(array('page_first_result' => $page_first_result, 'results_per_page' => $results_per_page));
        // for storing reviews
        $reviews = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $reviews[] = [
                'review_id' => $row['review_id'],
                'username' => $row['username'],
                'rating' => $row['rating'],
                'review_date' => $row['review_date'],
                'comment' => $row['comment'],
                'number_of_pages' => $number_of_pages,
            ];
        }
        return $reviews;
    }
    public function getAllWithoutPages()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM reviews ORDER BY review_date DESC, review_id DESC;');
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}