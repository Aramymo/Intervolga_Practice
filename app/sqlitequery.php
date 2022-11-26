<?php
namespace App;

class SQLiteQuery{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getReviews($review_id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM reviews
                                     WHERE review_id = :review_id;');

        $stmt->execute([':review_id' => $review_id]);

        // for storing reviews
        $reviews = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $reviews[] = [
                'review_id' => $row['review_id'],
                'username' => $row['username'],
                'rating' => $row['rating'],
                'review_date' => $row['review_date'],
                'comment' => $row['comment'],
            ];
        }

        return json_encode($reviews,JSON_UNESCAPED_UNICODE);
    }
    public function getAll($page)
    {
        $number_of_rows = $this->pdo->query('select count(*) from reviews')->fetchColumn();
        $results_per_page = 20;
        $number_of_pages = ceil($number_of_rows/$results_per_page);

        if ($page <= 0) {
            $page = 1;
        }
        echo $page;
        $page_first_result = ($page-1) * $results_per_page;
        $stmt = $this->pdo->prepare('SELECT * FROM reviews
                                     ORDER BY review_date DESC LIMIT :page_first_result, :results_per_page;');
//        $stmt = $this->pdo->prepare('SELECT * FROM reviews
//                                     ORDER BY review_date DESC;');
        $stmt->execute(array('page_first_result' => $page_first_result, 'results_per_page' => $results_per_page));
        //$stmt->execute();
        // for storing reviews
        $reviews = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $reviews[] = [
                'review_id' => $row['review_id'],
                'username' => $row['username'],
                'rating' => $row['rating'],
                'review_date' => $row['review_date'],
                'comment' => $row['comment'],
            ];
        }
        return json_encode($reviews,JSON_UNESCAPED_UNICODE);
    }
    public function addReview()
    {
        
    }

    public function deleteReview()
    {

    }
}