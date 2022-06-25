<?php

namespace App\Exceptions;

use Throwable;
use Carbon\Carbon;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Log;
use App\Traits\ApiResponseStructure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class Handler extends ExceptionHandler
{
    use ApiResponseStructure;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request,Throwable $e)
    {
        if($e instanceof  ModelNotFoundException || $e instanceof NotFoundHttpException)
        {
            return $this->error('Resource not found',Response::HTTP_NOT_FOUND,null);
        }
        Log::error("[Error encountered in file ] " . $e->getFile(). "  Time : " .Carbon::now()->toDateTimeString());
        Log::error("[Error encountered on line ] " . $e->getLine());
        Log::error("[Exception Message]". $e->getMessage());
        return $this->error('Error handling request',Response::HTTP_INTERNAL_SERVER_ERROR,null);
    }
}
