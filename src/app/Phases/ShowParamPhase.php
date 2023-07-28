<?php

namespace App\Phases;

use Adbar\Dot;
use Closure;
use Phase\Http\Phase\Phase;
use Phase\Http\Response\ViewResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowParamPhase extends Phase
{
    public function handle(Dot $state): Response
    {
        return new ViewResponse('greeting.html', ['greeting' => $this->params['name']]);
    }
}