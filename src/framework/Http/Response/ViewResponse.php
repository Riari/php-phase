<?php

namespace Phase\Http\Response;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewResponse extends Response
{
    public function __construct(string $view, array $params, int $status = 200, array $headers = [])
    {
        // TODO: Don't hardcode the paths here
        $loader = new FilesystemLoader('../views');
        $twig = new Environment($loader, [
            'cache' => '../storage/cache/views',
        ]);

        // TODO: Handle Twig errors
        parent::__construct($twig->render($view, $params), $status, $headers);
    }
}