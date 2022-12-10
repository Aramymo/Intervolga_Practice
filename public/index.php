<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use App\SQLiteConnection;
use App\SQLiteQuery;
use App\SQLiteAdd;
use App\SQLiteDelete;
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
$app->add(new BasicAuthentication([
    "path" => ["/api/delete_review/", "/api/delete/"],
    "users" => [
        $json['Admin_Login'] => $json['Admin_Password']
    ]
]));

$app->get('/', function (Request $request, Response $response){
    $renderer = new PhpRenderer('./templates');
    return $renderer->render($response,"reviews.php");
});

$app->get('/api/feedbacks/{id}/', function (Request $request, Response $response, array $args){
    header('Content-type: application/json; charset=utf-8');
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new SQLiteQuery($pdo);
    $review_id = (int)$args['id'];
    $result = $sqlite->getReviewById($review_id);
    $result = json_encode($result,JSON_UNESCAPED_UNICODE);
    $response->getBody()->write($result);
    return $response
        ->withHeader('content-type','application/json');
});
$app->get('/api/feedbacks/page={page}', function (Request $request, Response $response, array $args){
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new SQLiteQuery($pdo);
    $page = (int)$args['page'];
    $results = $sqlite->getAllReviews($page);
    $results = json_encode($results,JSON_UNESCAPED_UNICODE);
    $response->getBody()->write($results);
   return $response->withHeader("Access-Control-Allow-Origin",'*');
});

$app->get('/api/feedbacks/', function (Request $request, Response $response, array $args){
    $renderer = new PhpRenderer('./templates/');
    return $renderer->render($response,"review_pages.php");
});

$app->get('/add/', function (Request $request, Response $response, array $args){
    $renderer = new PhpRenderer('./templates/reviews/');
    return $renderer->render($response,"add_review.php");
});

$app->post('/api/add_review/', function (Request $request, Response $response, array $args){
    header('Content-type: application/json; charset=utf-8');
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new SQLiteAdd($pdo);
    $data = $request->getParsedBody();
    $username = $data['username'];
    $rating = $data['rating'];
    $comment = $data['comment'];
    $result = $sqlite->addReview($username, $rating, $comment);
    $result = json_encode($result,JSON_UNESCAPED_UNICODE);
    $response->getbody()->write($result);
    return $response
        ->withHeader("Access-Control-Allow-Origin",'*')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
});

$app->get('/api/delete/', function (Request $request, Response $response, array $args){
    $renderer = new PhpRenderer('./templates/reviews/');
    return $renderer->render($response,"delete_review.php");
});

$app->post('/api/delete_review/', function (Request $request, Response $response, array $args){
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new SQLiteDelete($pdo);
    $data = $request->getParsedBody();
    $review_id = $data['review_id'];
    $sqlite->deleteReview($review_id);
    return $response
        ->withHeader("Access-Control-Allow-Origin",'*')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
});

$app->run();