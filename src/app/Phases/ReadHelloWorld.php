<?php

namespace App\Phases;

use Adbar\Dot;
use Phase\Http\Phase\Phase;
use Phase\Http\Response\ViewResponse;
use Symfony\Component\HttpFoundation\Response;

class ReadHelloWorld extends Phase
{
    public function handle(Dot $state): Response
    {
        $hello = $state->get('hello');
        $world = $state->get('world');
        $greeting = "{$hello} {$world}!";

        return new ViewResponse('greeting.html', ['greeting' => $greeting]);
    }
}