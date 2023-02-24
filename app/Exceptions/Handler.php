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
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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
        // $this->reportable(function (Throwable $e) {
        //     //
        // });
            
        // if ($exception instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException) {
        //     return response()->json(["error" => $exception->getMessage()], 401);
        // }
        
        $this->renderable(function ($exception, $request) {

            // return response()->view('errors.custom', [], 500);
            return response()->json(['error' => $request], 401);
            if ($exception instanceof TokenExpiredException) {
                return response()->json(['error' => 'Token Expired'], 401);
            } else if ($exception instanceof TokenInvalidException) {
                return response()->json(['error' => 'Token Invalid'], 401);
            } else if ($exception instanceof JWTException) {
                return response()->json(['error' => 'Token Absent'], 401);
            }
        });
        
    }

}
