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
        //Подготовка запроса к БД
        $stmt = $this->pdo->prepare('SELECT * FROM reviews
                                     WHERE review_id = :review_id;');
        //Защита от инъекций
        $stmt->execute([':review_id' => $review_id]);
        //Массив для отзыва
        $review = [];
        //Получение строки
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        //Заполнение массива
        $review[] = [
            'review_id' => $row['review_id'],
            'username' => $row['username'],
            'rating' => $row['rating'],
            'review_date' => $row['review_date'],
            'comment' => $row['comment'],
        ];

        return $review;
    }
    public function getAllReviews($page)
    {
        //Получение количества отзывов
        $number_of_rows = $this->pdo->query('SELECT COUNT(*) FROM reviews')->fetchColumn();
        //Количество отзывов на странице
        $results_per_page = 20;
        //Количество страниц, ceil - возвращает округлённую до целого дробь
        $number_of_pages = ceil($number_of_rows/$results_per_page);
        //Обработка исключений для номера страницы
        $page = ceil($page);
        if ($page <= 0) {
            $page = 1;
        }
        if ($page > $number_of_pages)
        {
            $page = $number_of_pages;
        }
        //Получение числа, с которого надо начинать отображать данные
        $page_first_result = ($page-1) * $results_per_page;
        //Подготовка запроса
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