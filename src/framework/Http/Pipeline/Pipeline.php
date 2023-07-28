<?php

namespace Phase\Http\Pipeline;

use Adbar\Dot;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Pipeline implements IPipeline
{
    private array $phases = [];

    public function addAll(array $phases): void
    {
        $this->phases = array_merge($this->phases, $phases);
    }

    public function then(string $phase): Pipeline
    {
        $this->phases[] = $phase;
        return $this;
    }

    public function run(Request $request, array $params, Dot $state = new Dot): Response
    {
        $pipeline = array_reduce(
            array_reverse($this->phases),
            function ($nextClosure, $phaseClass) use ($request, $params) {
                return function ($state) use ($nextClosure, $phaseClass, $request, $params) {
                    $phase = new $phaseClass($nextClosure, $request, $params);
                    return $phase->handle($state);
                };
            },
            // Dummy closure to make this work. Maybe there's a nicer way of handling this.
            fn() => null
        );

        return $pipeline($state);
    }
}