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

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function($request,$handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,PATCH,OPTIONS');
});

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
    header('Content-type: text/html; charset=utf-8');
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new SQLiteQuery($pdo);
    $data = $request->getParsedBody();
    $username = $data['username'];
    $rating = $data['rating'];
    $comment = $data['comment'];
    $result = $sqlite->addReview($username, $rating, $comment);
    $response->getBody()->write($result);
    return $response;
});

$app->run();