<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Socket\Raw\Exception as SocketException;
use ErrorException;
use Throwable;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException || $e instanceof  NotFoundHttpException) {
            $message = 'Not Found';
            $status = 404;
        }

        if ($e instanceof SocketException) {
            $message = 'Connection error';
            $status = 500;
        }

        if ($e instanceof ErrorException) {
            $message = !empty($e->getMessage()) ? $e->getMessage() : 'Error';
            $status = 400;
        }

        if(method_exists($e, 'getStatusCode')){
            $message = $e->getMessage();
            $status = $e->getStatusCode();
        }

        if (!empty($message) && !empty($status)) {
            return response()->json(['message' => $message], $status);
        }

        return parent::render($request, $e);
    }
}
