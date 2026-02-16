<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register your custom route middleware here
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        $middleware->redirectGuestsTo(fn () => route('login.add'));
        // If you need to add global middleware, you would do it like this:
        // $middleware->web(append: [
        //     \App\Http\Middleware\SomeGlobalMiddleware::class,
        // ]);

        // If you need to modify existing middleware groups, e.g., 'web'
        // $middleware->web(remove: \App\Http\Middleware\PreventRequestsDuringMaintenance::class);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();