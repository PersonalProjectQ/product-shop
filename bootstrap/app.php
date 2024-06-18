<?php

use App\Exceptions\RepositoryException;
use App\Exceptions\UnAuthorizedException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (Exception $exception) {
            Log::error($exception->__toString());
        });

        $exceptions->render(function (ModelNotFoundException $e, Request $request) {

            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'type' => 'Exception',
                ], Response::HTTP_NOT_FOUND);
            }
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) {

            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'type' => 'Authorized',
                ], Response::HTTP_UNAUTHORIZED);
            }
        });

        $exceptions->render(function (UnAuthorizedException $e, Request $request) {

            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'type' => 'Unauthorized',
                ], Response::HTTP_UNAUTHORIZED);
            }
        });

        $exceptions->render(function (RepositoryException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'type' => 'Repository',
                ], $e->getCode());
            }
        });

        $exceptions->render(function (RepositoryException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'type' => 'Service',
                ], $e->getCode());
            }
        });

        $exceptions->render(function (Error $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'type' => 'Error',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });


    })->create();
