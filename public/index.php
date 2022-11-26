<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use App\SQLiteConnection;
use App\SQLiteQuery;

require __DIR__ . '/../vendor/autoload.php';
$app = AppFactory::create();
$container = $app->getContainer();


$app->get('/', function (Request $request, Response $response){
    header('Content-type: text/html; charset=utf-8');
    $renderer = new PhpRenderer('./templates');
    return $renderer->render($response,"reviews.phtml");
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
    echo $result;
    return $response;
});
$app->get('/api/feedbacks/page/{page}/', function (Request $request, Response $response, array $args){
    header('Content-type: application/json; charset=utf-8');
    $pdo = (new SQLiteConnection())->connect();
    if($pdo != null)
        echo 'abobus';
    else
        echo 'amogus';
    $sqlite = new SQLiteQuery($pdo);
    $page = (int)$args['page'];
    $result = $sqlite->getAll($page);
    echo $result;
    return $response;
});


$app->run();