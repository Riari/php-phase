<?php

namespace Phase\Http\Phase;

use Abdar\Dot;
use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * A phase is a distinct part of a pipeline. There should be at least one phase attached to a route to handle it.
 * 
 * The last phase in a route is responsible for terminating by sending a response.
 * 
 * A phase is a bit like an action in terms of how it's used (i.e. a class designed to handle a specific thing and
 * has one public method to do so), but it deals specifically with the HTTP side of things, whereas actions should
 * not handle requests or responses at all.
 */
interface IPhase
{
    /**
     * Handle the request. This may execute business logic or execute one or more actions.
     * 
     * @param \Abdar\Dot $state
     */
    public function handle(Dot $state): Response;

    /**
     * Call the next phase (if there is one).
     * 
     * @param \Abdar\Dot $state
     */
    public function next(Dot $state): Response;
}