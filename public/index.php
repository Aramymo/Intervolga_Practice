<?php


use App\Middleware\SessionMiddleware;
use App\Middleware\AuthMiddleware;
use App\SQLiteAdd;
use App\SQLiteDelete;
use App\sqlitequery;
use App\sqliteupdate;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;


require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true,true,false);
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();

$app->addMiddleware(new AuthMiddleware(array(
        "protected" => array(
                "/admin_panel/",
                "/deauth",
        ),
        "ignore" => array(
                '/api/add_review/',
                '/api/feedbacks/',
            '/api/authorize',
        ),
)));

$app->addMiddleware(new SessionMiddleware());

$reviewedProductTypes = array(
        'Мебель' => 'Мебель',
        'Еда' => 'Еда',
        'Техника' => 'Техника',
);

//Ендпоинт отображения домашней страницы
$app->get('/',
        function (Request $request, Response $response) {
            $renderer = new PhpRenderer('./templates');

            return $renderer->render($response,"index.php");
        }
);

//Ендпоинт отображения страницы отзывов
$app->get('/feedbacks/',
        function (Request $request, Response $response) {
            $renderer = new PhpRenderer('./templates/');

            return $renderer->render($response,"reviews_page.php");
        }
);

//Ендпоинт отображения страницы добавления отзыва
$app->get('/add/',
        function (Request $request, Response $response) use ($reviewedProductTypes) {
            $renderer = new PhpRenderer('./templates/');

            return $renderer->render($response,"add_review.php", array( 'select_fields' => $reviewedProductTypes));
        }
);

$app->get('/auth',
        function (Request $request, Response $response) {
            $renderer = new PhpRenderer('./templates/');

            return $renderer->render($response,"login_page.php");
        }
);

$app->post('/deauth',
        function (Request $request, Response $response) {
            session_unset();
            session_destroy();

            return $response->withHeader("Access-Control-Allow-Origin",'*')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST')
                    ->withHeader('Location', '/');
        }
);

//Ендпоинт отображения страницы удаления отзывов
$app->get('/admin_panel/',
        function (Request $request, Response $response) {
            $sqlite = new sqlitequery();
            $reviews = $sqlite->getAllWithoutPages();
            $renderer = new PhpRenderer('./templates/');

            return $renderer->render($response,"review_page_adm.php", $reviews);
        }
);

$app->get('/admin_panel/update/{id}',
        function (Request $request, Response $response, array $args) use ($reviewedProductTypes) {
            $sqlite = new sqlitequery();
            $id = (int)$args['id'];
            $reviewData = $sqlite->getReviewById($id);
            $reviewData['select_fields'] = $reviewedProductTypes;
            $renderer = new PhpRenderer('./templates/');

            return $renderer->render($response, 'update_review.php', $reviewData);
        }
);

$app->post('/api/authorize/',
        function (Request $request, Response $response) {
            $data = $request->getParsedBody();
            $username = $data['username'];
            $password = $data['password'];
            $path = __DIR__ . '/../config/config.json';
            $config_handle = fopen($path, 'r');
            $text = fread($config_handle,filesize($path));
            $json = json_decode($text, true);
            fclose($config_handle);

            if ($username === $json['Admin_Login'] && $password === $json['Admin_Password']) {
                $_SESSION['AUTHORIZED'] = 1;
                $data['redirect_uri'] = !(empty($data['redirect_uri'])) ?: '/';

                return $response->withHeader("Access-Control-Allow-Origin",'*')
                        ->withHeader('Access-Control-Allow-Methods', 'GET, POST')
                        ->withHeader('Location', $data['redirect_uri'])
                        ->withStatus(200);
            }

            return $response->withHeader("Access-Control-Allow-Origin",'*')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST')
                    ->withStatus(401);
        }
);

//Ендпоинт для получения определённого отзыва
$app->get('/api/feedbacks/{id}/',
        function (Request $request, Response $response, array $args) {
            header('Content-type: application/json; charset=utf-8');

            $sqlite = new sqlitequery();
            $review_id = (int)$args['id'];
            $result = $sqlite->getReviewById($review_id);
            $result = json_encode($result,JSON_UNESCAPED_UNICODE);
            $response->getBody()->write($result);

            return $response->withHeader('content-type','application/json');
        }
);

//Ендпоинт для получения всех отзывов с постраничным отображением
$app->get('/api/feedbacks/page={page}',
        function (Request $request, Response $response, array $args) {
            $sqlite = new sqlitequery();
            $page = (int)$args['page'];
            $results = $sqlite->getAllReviews($page);
            $results = json_encode($results,JSON_UNESCAPED_UNICODE);
            $response->getBody()->write($results);

            return $response->withHeader("Access-Control-Allow-Origin",'*');
        }
);

//Ендпоинт для добавления отзыва
$app->post('/api/add_review/',
        function (Request $request, Response $response) {
            header('Content-type: application/json; charset=utf-8');
            $sqlite = new SQLiteAdd();
            $data = $request->getParsedBody();
            $result = $sqlite->addReview($data);
            $result = json_encode($result,JSON_UNESCAPED_UNICODE);
            $response->getbody()->write($result);

            return $response->withHeader("Access-Control-Allow-Origin",'*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
        }
);

//Ендпоинт удаления отзыва
$app->post('/api/delete_review/',
        function (Request $request, Response $response) {
            $sqlite = new SQLiteDelete();
            $data = $request->getParsedBody();
            $review_id = $data['review_id'];
            $sqlite->deleteReview($review_id);

            return $response->withHeader("Access-Control-Allow-Origin",'*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
        }
);

$app->post('/api/update_review/',
        function (Request $request, Response $response) {
        $sqlite = new sqliteupdate();
        $data = $request->getParsedBody();
        $sqlite->updateReview($data['review_id'], $data);

        return $response
                ->withHeader("Access-Control-Allow-Origin",'*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
        }
);

$app->run();