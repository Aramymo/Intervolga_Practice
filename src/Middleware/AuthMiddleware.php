<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class AuthMiddleware implements MiddlewareInterface
{
    /**
     * Invoke middleware.
     *
     * @param ServerRequestInterface $request The request
     * @param RequestHandlerInterface $handler The handler
     *
     * @return Response The response
     */

    private array $endpoints;

    public function __construct(array $endpoints)
    {
        $this->endpoints = $endpoints;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): Response
    {
        $currentUri = $request->getUri()->getPath();

        if (in_array($currentUri, $this->endpoints) && empty($_SESSION['AUTHORIZED'])) {
            return (new \Slim\Psr7\Response())
                    ->withHeader('Location', '/auth?redirect=' . $currentUri)
                    ->withStatus(302);
        }

        return $handler->handle($request);
    }
}
