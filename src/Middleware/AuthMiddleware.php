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

    private array $protectedEndpoints;
    private array $ignoredEndpoints;

    public function __construct(array $endpoints)
    {
        $this->protectedEndpoints = $endpoints['protected'];
        $this->ignoredEndpoints = $endpoints['ignore'];
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): Response
    {
        $currentUri = $request->getUri()->getPath();
        $currentUri = (string) preg_replace("#/+#", "/", $currentUri);

        if (self::isUriProtected($currentUri) && empty($_SESSION['AUTHORIZED'])) {
            if (str_contains($currentUri,'/api/')) {
                header('Location', '/');
            } else {
                header('Location', '/auth?redirect=' . $currentUri);
            }
            return (new \Slim\Psr7\Response())
                    ->withStatus(401);
        }

        return $handler->handle($request);
    }

    private function isUriProtected(string $currentUri): bool {
        foreach ($this->ignoredEndpoints as $ignored) {
            $ignored = rtrim($ignored, "/");
            if (!!preg_match("@^{$ignored}(/.*)?$@", $currentUri)) {
                return false;
            }
        }

        foreach ($this->protectedEndpoints as $protected) {
            $protected = rtrim($protected, "/");
            if (!!preg_match("@^{$protected}(/.*)?$@", $currentUri)) {
                return true;
            }
        }
        return false;
    }
}
