<?php

namespace App\Phases;

use Adbar\Dot;
use Closure;
// TODO: Come up with a better namespace for phases because this is a bit silly!
use Phase\Http\Phase\Phase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloPhase extends Phase
{
    public function handle(Request $request, Dot $state): Response
    {
        $state->add('hello', "Hello");

        return $this->next($request, $state);
    }
}