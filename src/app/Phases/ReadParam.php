<?php

namespace App\Phases;

use Adbar\Dot;
use Phase\Http\Phase\Phase;
use Phase\Http\Response\ViewResponse;
use Symfony\Component\HttpFoundation\Response;

class ReadParam extends Phase
{
    public function handle(Dot $state): Response
    {
        return new ViewResponse('greeting.html', ['greeting' => $this->params['name']]);
    }
}