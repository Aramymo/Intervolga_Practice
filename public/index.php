<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\SQLiteConnection;
use App\SQLiteQuery;

require __DIR__ . '/../vendor/autoload.php';
//require_once(dirname(__DIR__).'/app/dependencies.php');
header('Content-type: application/json; charset=utf-8');
$app = AppFactory::create();

//$app->get('/', function (Request $request, Response $response, $args) {
//    $response->getBody()->write("Hello world!");
//    return $response;
//});

$app->get('/', function (Request $request, Response $response){
    $pdo = (new SQLiteConnection())->connect();
    if($pdo != null)
        echo 'aboba';
    else
        echo 'amogus';
    return $response;
});

$app->get('/api/feedbacks/{id}/', function (Request $request, Response $response, array $args){
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
//$app->get('/db-test', function (Request $request, Response $response) {
//    $db = $this->get(PDO::class);
//    $sth = $db->prepare("SELECT * FROM reviews");
//    $sth->execute();
//    $data = $sth->fetchAll(PDO::FETCH_ASSOC);
//    $payload = json_encode($data);
//    $response->getBody()->write($payload);
//    return $response->withHeader('Content-Type', 'application/json');
//});

$app->run();