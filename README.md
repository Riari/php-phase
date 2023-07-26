# Phase - PHP framework

This is a crude exploration of a concept for a PHP framework that follows the "MV" of the MVC pattern, but replaces the "C" with _phases_, which are a bit like middleware in Laravel, but they're designed to handle the whole flow from request to response instead of just the "before" and "after".

It also emphasises the use of actions for handling business logic, the idea being that you can combine phases and actions to fulfil any request without having to write controller actions unique to each route. In theory, the framework could come with phases out of the box for things like authentication and validation.

My thinking is that this would encourage a healthy amount of granularity and produce applications that are easier to write unit tests for, but in practice it might not be great to work with, or it might suck altogether, but I'm here to find out! I'll update this with more notes/documentation depending on how far I go.