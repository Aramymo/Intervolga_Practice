<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use App\SQLiteConnection;
use App\SQLiteQuery;

require __DIR__ . '/../vendor/autoload.php';
//require_once('./templates/add_review.php');
$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();

$app->get('/', function (Request $request, Response $response){
    header('Content-type: text/html; charset=utf-8');
    $renderer = new PhpRenderer('./templates');
    return $renderer->render($response,"reviews.php");
});

$app->get('/api/feedbacks/{id}/', function (Request $request, Response $response, array $args){
    header('Content-type: application/json; charset=utf-8');
    $pdo = (new SQLiteConnection())->connect();
    if($pdo != null)
        echo 'aboba';
    else
        echo 'amogus';
    $sqlite = new SQLiteQuery($pdo);
    $review_id = (int)$args['id'];
    $result = $sqlite->getReviews($review_id);
    $response->getBody()->write($result);
    return $response
        ->withHeader('content-type','application/json');
});
$app->get('/api/feedbacks/page/{page}/', function (Request $request, Response $response, array $args){
    $pdo = (new SQLiteConnection())->connect();
    if($pdo != null)
        echo 'abobus';
    else
        echo 'amogus';
    $sqlite = new SQLiteQuery($pdo);
    $page = (int)$args['page'];
    $result = $sqlite->getAll($page);
    $response->getBody()->write($result);
    return $response
        ->withHeader('content-type','application/json');
});

$app->get('/api/add_review/', function (Request $request, Response $response, array $args){
    header('Content-type: text/html; charset=utf-8');
    $renderer = new PhpRenderer('./templates');
    return $renderer->render($response,"add_review.php");
});

$app->post('/api/add_review/', function (Request $request, Response $response, array $args){
    header('Content-type: application/json; charset=utf-8');
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new SQLiteQuery($pdo);
    $data = $request->getParsedBody();
    $username = $data['username'];
    $rating = $data['rating'];
    $comment = $data['comment'];
    $sqlite->addReview($username, $rating, $comment);
    return $response
        ->withHeader('Location', '/api/add_review/')
        ->withStatus(302);
});

$app->get('/api/delete_review/', function (Request $request, Response $response, array $args){
    header('Content-type: text/html; charset=utf-8');
    $renderer = new PhpRenderer('./templates');
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new SQLiteQuery($pdo);
    $result = $sqlite->getAllWithoutPages();
    return $renderer->render($response,"delete_review.php");
});
$app->post('/api/delete_review/', function (Request $request, Response $response, array $args){
    header('Content-type: application/json; charset=utf-8');
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new SQLiteQuery($pdo);
    $result = $sqlite->getAllWithoutPages();
    $data = $request->getParsedBody();
    $review_id = $data['review_id'];
//    $review_id = (int)$args['id'];
//    echo "$review_id";
    $sqlite->deleteReview($review_id);
    return $response
        ->withHeader('Location', '/api/delete_review/')
        ->withStatus(302);
});

$app->run();