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

    public function run(Request $request, $state = new Dot): Response
    {
        $pipeline = array_reduce(
            array_reverse($this->phases),
            function ($nextClosure, $phaseClass) {
                return function ($request, $state) use ($nextClosure, $phaseClass) {
                    $phase = new $phaseClass($nextClosure);
                    return $phase->handle($request, $state);
                };
            },
            // Dummy closure to make this work. Maybe there's a nicer way of handling this.
            function () {}
        );

        return $pipeline($request, $state);
    }
}