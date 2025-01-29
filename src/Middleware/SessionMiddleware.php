<?php

namespace App\Middleware;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;


final class SessionMiddleware implements MiddlewareInterface {
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): Response {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!empty($request->getAttribute('AUTHORIZED'))) {
            $_SESSION['AUTHORIZED'] = 1;
        }

        $response = $handler->handle($request);
        session_write_close();

        return $response;
    }
}
