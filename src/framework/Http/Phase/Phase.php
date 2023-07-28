<?php

namespace Phase\Http\Phase;

use Adbar\Dot;
use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// TODO: implementing IPhase causes the following error:
// Fatal error: Could not check compatibility between Phase\Http\Phase\Phase::handle(Symfony\Component\HttpFoundation\Request $request, Adbar\Dot $state): Symfony\Component\HttpFoundation\Response and Phase\Http\Phase\IPhase::handle(Symfony\Component\HttpFoundation\Request $request, Abdar\Dot $state): Symfony\Component\HttpFoundation\Response, because class Abdar\Dot is not available in /src/framework/Http/Phase/Phase.php on line 19
abstract class Phase // implements IPhase
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