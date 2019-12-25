<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception $exception
     * @return Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException && $request->is('api/*')) {
            report($exception);
            return response()->json(['errors' => $exception->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*if ($exception instanceof FatalThrowableError && $request->is('api/*')) {
            report($exception);
            return response()->json(['errors' => 'Entry Class Not Found !!!'], JsonResponse::HTTP_BAD_REQUEST);
        }*/

        if ($exception instanceof RelationNotFoundException && $request->is('api/*')) {
            $model = get_class($exception->model);
            $relation = $exception->relation;
            report($exception);
            return response()->json(['errors' => "Call to undefined relationship [{$model}] on model [{$relation}]."], JsonResponse::HTTP_NOT_ACCEPTABLE);
        }
        if ($exception instanceof ModelNotFoundException && $request->is('api/*')) {
            report($exception);
            return response()->json(['errors' => $exception->errors()], JsonResponse::HTTP_NOT_FOUND);
        }

        return parent::render($request, $exception);
    }
}
