<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
//     public function render($request, Exception $exception)
// {
//     $response = parent::render($request, $exception);

//     if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
//         $response = response()->json(['error' => 'تم انتهاء صلاحية التوكن. الرجاء تسجيل الدخول مرة أخرى.'], 401);
//     }

//     return $response;
// }


}
