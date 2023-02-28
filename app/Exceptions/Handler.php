<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Response;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;

// use Tymon\JWTAuth\Exceptions\TokenExpiredException;
// use Tymon\JWTAuth\Exceptions\TokenInvalidException;
// use Tymon\JWTAuth\Exceptions\JWTException;
// use App\Exceptions\Exception;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function () {});
    }

    // Sentry reporting
    public function report(Throwable $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->isJson()) {
            return $this->handleApiException($request, $exception);
        }

        return parent::render($request, $exception);
    }

    private function handleApiException($request, Throwable $exception)
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof \Illuminate\Http\Exceptions\HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }

        return $this->customApiResponse($exception);
    }

    private function customApiResponse($exception)
    {
        $statusCode = 500;

        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        }

        $response = [];

        switch ($statusCode) {
        case 401:
            $response['title'] = 'Unauthorized';
            break;
        case 403:
            $response['title'] = 'Forbidden';
            break;
        case 404:
            $response['title'] = 'Not Found';
            break;
        case 405:
            $response['title'] = 'Method Not Allowed';
            break;
        case 422:
            $response['title'] = 'Unprocessable Entity';
            // $response['title'] = $exception->original['message'];
            if (isset($exception->original['errors'])) {
                $response['detail'] = $exception->original['errors'];
            }
            break;
        case 429:
            $response['title'] = 'Too Many Requests';
            break;
        default:
            $response['title'] = 'Whoops, looks like something went wrong';
            break;
        }

        if (method_exists($exception, 'getMessage')) {
            if ($exception->getMessage() != null) {
                $response['title'] = $exception->getMessage();
                if ($exception->getMessage() == 'Invalid scope(s) provided.') {
                    $response['title'] = 'Invalid Scope';
                } elseif (str_contains($exception->getMessage(), 'No query results for model')) {
                    $response['title'] = 'Not Found';
                }
            }
        }

        $response['status'] = $statusCode;
        $response['type'] = 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/' . $statusCode;

        if (config('app.debug')) {
            $response['trace'] = $exception->getTrace();
        }

        return response()->json(['error' => $response], $statusCode)->header('Content-Type', 'application/problem+json');
    }
}