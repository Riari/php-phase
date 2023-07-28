<?php

namespace App\Phases;

use Adbar\Dot;
// TODO: Come up with a better namespace for phases because this is a bit silly!
use Phase\Http\Phase\Phase;
use Symfony\Component\HttpFoundation\Response;

class WriteHello extends Phase
{
    public function handle(Dot $state): Response
    {
        $state->add('hello', "Hello");

        return $this->next($state);
    }
}