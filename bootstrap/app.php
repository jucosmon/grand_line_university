<?php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use App\Providers\AppServiceProvider;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        // Define middleware groups
        $middleware->group('student', [
            \App\Http\Middleware\StudentMiddleware::class,
        ]);

        $middleware->group('teacher', [
            \App\Http\Middleware\TeacherMiddleware::class,
        ]);

        $middleware->group('admin', [
            \App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();

$router = $app->make(Router::class);
$app->register(AppServiceProvider::class);
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);


// Use middleware groups in router
// Use middleware groups in router
$router->middlewareGroup('student', []);
$router->middlewareGroup('teacher', []);
$router->middlewareGroup('admin', []);

return $app;
