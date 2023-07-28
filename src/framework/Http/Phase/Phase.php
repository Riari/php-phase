<?php

namespace Phase\Http\Phase;

use Adbar\Dot;
use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class Phase implements IPhase
{
    private readonly Closure $next;
    private readonly Request $request;
    private readonly array $params;

    public function __construct(Closure $next, Request $request, array $params)
    {
        $this->next = $next;
        $this->request = $request;
        $this->params = $params;
    }

    public abstract function handle(Dot $state): Response;

    public function next(Dot $state): Response
    {
        return call_user_func($this->next, $state);
    }
}