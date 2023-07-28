<?php

namespace App\Phases;

use Adbar\Dot;
use Closure;
use Phase\Http\Phase\Phase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WorldPhase extends Phase
{
    public function handle(Dot $state): Response
    {
        $state->add('world', "World");

        return $this->next($state);
    }
}