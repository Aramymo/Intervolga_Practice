<?php

use App\Middleware\SessionMiddleware;
use App\SQLiteAdd;
use App\SQLiteDelete;
use App\sqlitequery;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use Tuupola\Middleware\HttpBasicAuthentication as BasicAuthentication;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true,true,false);
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();

$path = __DIR__ . '/../config/config.json';
$config_handle = fopen($path, 'r');
$text = fread($config_handle,filesize($path));
$json = json_decode($text, true);
fclose($config_handle);

$app->addMiddleware(new SessionMiddleware());

$app->add(new BasicAuthentication([
        "path" => ["/api/delete_review/", "/admin_panel/", "/api/quit/"],
        "users" => [
                $json['Admin_Login'] => $json['Admin_Password']
        ],
        "before" => function ($request, $arguments) use ($json) {
            return $request->withAttribute("AUTHORIZED", $arguments["user"]);
        },
]));

$path = __DIR__ . '/../config/config.json';
$config_handle = fopen($path, 'r');
$text = fread($config_handle,filesize($path));
$json = json_decode($text, true);
fclose($config_handle);

//Добавление аутентификации, на перечисленные в path пути будет
//требоваться логин и пароль, правильные указаны в users

//Hello world ендпоинт
$app->get('/hello', function(Request $request, Response $response){
   $response->getBody()->write("Hello World!");
   return $response;
});

//Ендпоинт отображения домашней страницы
$app->get('/', function (Request $request, Response $response){
    $renderer = new PhpRenderer('./templates');
    return $renderer->render($response,"reviews.php");
});

//Ендпоинт отображения страницы отзывов
$app->get('/feedbacks/', function (Request $request, Response $response){
    $renderer = new PhpRenderer('./templates/');
    return $renderer->render($response,"review_pages.php");
});

//Ендпоинт отображения страницы добавления отзыва
$app->get('/add/', function (Request $request, Response $response){
    $renderer = new PhpRenderer('./templates/reviews/');
    return $renderer->render($response,"add_review.php");
});

//Ендпоинт отображения страницы удаления отзывов
$app->get('/admin_panel/', function (Request $request, Response $response){
    $sqlite = new sqlitequery();
    //Получение всех отзывов, без разделения на страницы
    $reviews = $sqlite->getAllWithoutPages();
    $renderer = new PhpRenderer('./templates/reviews/');
    return $renderer->render($response,"admin_panel.php", $reviews);
});

$app->get('/admin_panel/update/{id}', function (Request $request, Response $response, array $args){

    $sqlite = new sqlitequery();
    $id = (int)$args['id'];
    $reviewData = $sqlite->getReviewById($id);
    $renderer = new PhpRenderer('./templates/reviews/');
    return $renderer->render($response, 'update_review.php', $reviewData);
});

//Ендпоинт для получения определённого отзыва
$app->get('/api/feedbacks/{id}/', function (Request $request, Response $response, array $args){
    header('Content-type: application/json; charset=utf-8');
    // Создание объекта класса выборки
    $sqlite = new sqlitequery();
    // Получение айди отзыва
    $review_id = (int)$args['id'];
    // Вызов метода, который возвращает содержание отзыва
    $result = $sqlite->getReviewById($review_id);
    // Кодирование в json
    $result = json_encode($result,JSON_UNESCAPED_UNICODE);
    // Запись в тело запроса
    $response->getBody()->write($result);
    return $response
        ->withHeader('content-type','application/json');
});

//Ендпоинт для получения всех отзывов с постраничным отображением
$app->get('/api/feedbacks/page={page}', function (Request $request, Response $response, array $args){
    //
    $sqlite = new sqlitequery();
    //получение номера страницы
    $page = (int)$args['page'];
    //получение всех отзывов с этой страницы
    $results = $sqlite->getAllReviews($page);
    $results = json_encode($results,JSON_UNESCAPED_UNICODE);
    $response->getBody()->write($results);
   return $response->withHeader("Access-Control-Allow-Origin",'*');
});

//Ендпоинт для добавления отзыва
$app->post('/api/add_review/', function (Request $request, Response $response){
    header('Content-type: application/json; charset=utf-8');
    
    //Создание объекта класса добавления
    $sqlite = new SQLiteAdd();
    //Получение данных из пост-запроса
    $data = $request->getParsedBody();
    $username = $data['username'];
    $rating = $data['rating'];
    $comment = $data['comment'];
    //Запись полученных данных в БД
    $result = $sqlite->addReview($username, $rating, $comment);
    $result = json_encode($result,JSON_UNESCAPED_UNICODE);
    $response->getbody()->write($result);
    return $response
        ->withHeader("Access-Control-Allow-Origin",'*')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
});

//Ендпоинт удаления отзыва
$app->post('/api/delete_review/', function (Request $request, Response $response){
    
    //Создание объекта удаления отзыва
    $sqlite = new SQLiteDelete();
    $data = $request->getParsedBody();
    $review_id = $data['review_id'];
    //Удаление отзыва из БД
    $sqlite->deleteReview($review_id);
    return $response
        ->withHeader("Access-Control-Allow-Origin",'*')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
});

$app->post('/api/update_review/', function (Request $request, Response $response){
    //Создание объекта удаления отзыва
    $sqlite = new \App\sqliteupdate();
    $data = $request->getParsedBody();
    $review_id = $data['review_id'];
    $username = $data['username'];
    $rating = $data['rating'];
    $comment = $data['comment'];
    //Удаление отзыва из БД
    print_r($sqlite->updateReview($review_id, $username, $rating, $comment));
    return $response
            ->withHeader("Access-Control-Allow-Origin",'*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
});

$app->run();