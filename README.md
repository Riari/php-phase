# Phase - PHP framework

## Overview

This is a crude exploration of a concept for a PHP framework that follows the "MV" of the MVC pattern, but replaces the "C" with _phases_, which are a bit like middleware in Laravel, but they're designed to handle the whole flow from request to response instead of just the "before" and "after".

It also emphasises the use of actions for handling business logic, the idea being that you can combine phases and actions to fulfil any request without having to write controller actions unique to each route. In theory, the framework could come with phases out of the box for things like authentication and validation.

My thinking is that this would encourage a healthy amount of granularity and produce applications that are easier to write unit tests for, but in practice it might not be great to work with, or it might suck altogether, but I'm here to find out! I'll update this with more notes/documentation depending on how far I go.

## Usage notes

The basic building blocks are routes and phases. Routes can be defined in the app's web.php routes file (in this repo, that's `src/app/routes/web.php`). Phases are defined in the app's Phases directory (`src/app/Phases/`). A simple phase looks like this:

```php
<?php

namespace App\Phases;

use Adbar\Dot;
use Phase\Http\Phase\Phase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExamplePhase extends Phase
{
    public function handle(Request $request, array $params, Dot $state): Response
    {
        // Here's where you do something with the request. Note the three method parameters. In reverse order, they are:

        // Dot $state - this is a collection of values you can pass between phases. In the first phase of a route, it's empty
        // and ready to be written to.
        $state->add('some.value', 1);
        $someValue = $state->get('some.value'); // 1

        // array $params - this is a simple array of parameter values from the resolved route. You could approximate
        // Laravel's explicit route model binding feature by writing a phase to do it like so:
        if (isset($params['post']))
        {
            $state->add('models.post', Post::get($params['post']));
        }

        // Request $request - a Symfony request object for the current request. This would be useful for things like
        // authentication phases.

        // Phases ultimately return responses. If a phase is supposed to terminate, it can return a concrete response
        // like this:
        return new ViewResponse('template.html', ['someValue' => $someValue]);

        // Otherwise, it can proceed to the next phase for the route like this:
        return $this->next($request, $params, $state);
    }
}
```

A definition for a route with just one phase associated with it looks like this:

```php
$r->addRoute('GET', '/example/{param}', [ExamplePhase::class]);
```

The main issue with phases is the rigid interface. There's no DI or anything like that yet, and being forced to use the same `handle` method for every phase you implement (as opposed to pointing routes to custom methods) is not a great experience. I'm focusing on ways to improve that aspect.