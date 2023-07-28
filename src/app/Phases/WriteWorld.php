<?php

namespace App\Phases;

use Adbar\Dot;
use Phase\Http\Phase\Phase;
use Symfony\Component\HttpFoundation\Response;

class WriteWorld extends Phase
{
    public function handle(Dot $state): Response
    {
        $state->add('world', "World");

        return $this->next($state);
    }
}