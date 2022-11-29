<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
//use Psr\Http\Server\RequestHandlerInterface as RequestInterface;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use App\SQLiteConnection;
use App\SQLiteQuery;
use App\RegistrationAndLogin;
use App\Config;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true,true,false);
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();

$app->get('/', function (Request $request, Response $response){
    $renderer = new PhpRenderer('./templates');
    return $renderer->render($response,"reviews.php");
});
$app->post('/login', function (Request $request, Response $response){
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new RegistrationAndLogin($pdo);
    $data = $request->getParsedBody();
    $username = $data['username'];
    $password = $data['password'];
    $errors = $sqlite->checkLoginData($username,$password);
    if(count($errors) == 0)
    {
        $sqlite->loginUser($username,$password);
        $response->getBody()->write(json_encode($errors));
//        $_SESSION['username'] = $username;
        return $response
            ->withHeader("Access-Control-Allow-Origin",'*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
    }
    else
    {
        $response->getBody()->write(json_encode($errors));
        return $response
            ->withHeader("Access-Control-Allow-Origin",'*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
    }
});
$app->post('/registration', function (Request $request, Response $response){
    //header('Content-type: application/json; charset=utf-8');
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new RegistrationAndLogin($pdo);
    $data = $request->getParsedBody();
    $username = $data['username'];
    $user_email = $data['user_email'];
    $password1 = $data['password1'];
    $password2 = $data['password2'];
    $errors = $sqlite->checkRegistrationData($username,$user_email,$password1,$password2);
    if(count($errors) == 0)
    {
        $sqlite->registerUser($username,$user_email,$password1);
        $sqlite->loginUser($username,$password1);
//        $_SESSION['username'] = $username;
        $response->getBody()->write(json_encode($errors));
        return $response
            ->withHeader("Access-Control-Allow-Origin",'*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
    }
    else
    {
        $response->getBody()->write(json_encode($errors));
        return $response
            ->withHeader("Access-Control-Allow-Origin",'*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
    }
});

$app->get('/api/feedbacks/{id}/', function (Request $request, Response $response, array $args){
    header('Content-type: application/json; charset=utf-8');
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new SQLiteQuery($pdo);
    $review_id = (int)$args['id'];
    $result = $sqlite->getReviews($review_id);
    $response->getBody()->write($result);
    return $response
        ->withHeader('content-type','application/json');
});
$app->get('/api/feedbacks/page={page}', function (Request $request, Response $response, array $args){
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new SQLiteQuery($pdo);
    $page = (int)$args['page'];
    $results = $sqlite->getAll($page);
    $response->getBody()->write($results);
    return $response->withHeader("Access-Control-Allow-Origin",'*');
//    $renderer = new PhpRenderer('./templates/');
//    return $renderer->render($response,"review_pages.php",["results" => $results]);
});

$app->get('/api/feedbacks/', function (Request $request, Response $response, array $args){
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new SQLiteQuery($pdo);
    $results = $sqlite->getAll(1);
    $response->getBody()->write($results);
    return $response->withHeader("Access-Control-Allow-Origin",'*');
});

$app->post('/api/add_review/', function (Request $request, Response $response, array $args){
    header('Content-type: application/json; charset=utf-8');
    $pdo = (new SQLiteConnection())->connect();
    $sqlite = new SQLiteQuery($pdo);
    $data = $request->getParsedBody();
    $username = $data['username'];
    $rating = $data['rating'];
    $comment = $data['comment'];
    $response->getbody()->write($sqlite->addReview($username, $rating, $comment));
    return $response
        ->withHeader("Access-Control-Allow-Origin",'*')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
});

$app->get('/api/delete_review/', function (Request $request, Response $response, array $args){
    header('Content-type: text/html; charset=utf-8');
//    if(isset($_SESSION['username']) && $_SESSION['username'] == Config::ADMIN_LOGIN)
//    {
//        $renderer = new PhpRenderer('./templates/reviews/');
//        $pdo = (new SQLiteConnection())->connect();
//        $sqlite = new SQLiteQuery($pdo);
//        $sqlite->getAllWithoutPages();
//        return $renderer->render($response,"delete_review.php");
//    }
    //else
    //{
        return $response
            ->withStatus(404);
    //}
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