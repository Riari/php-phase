<?php

namespace Phase\Http\Pipeline;

use Adbar\Dot;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * A pipeline is a container for phases and handles running them.
 */
interface IPipeline
{
    public function run(Request $request, $state = new Dot): Response;
}