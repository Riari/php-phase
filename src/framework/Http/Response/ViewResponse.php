<?php

namespace Phase\Http\Response;

use RyanChandler\Blade\Blade;
use Symfony\Component\HttpFoundation\Response;

class ViewResponse extends Response
{
    public function __construct(string $view, array $params, int $status = 200, array $headers = [])
    {
        // TODO: Don't hardcode the paths here
        $blade = new Blade('../views', '../storage/cache/views');

        // TODO: Handle Twig errors
        parent::__construct($blade->make($view, $params)->render(), $status, $headers);
    }
}