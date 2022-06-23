<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
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
        if($e instanceof  ModelNotFoundException || $e instanceof NotFoundHttpException){
            return response()->json(['message'=>'Resource not found'],Response::HTTP_NOT_FOUND);
        }
        $res = [
            'message'=>$e->getMessage(),
            'file'=>$e->getFile(),
            'line' =>$e->getLine(),
            'trace'=>$e->getTraceAsString(),
           ];

       return response()->json($res,Response::HTTP_INTERNAL_SERVER_ERROR);


    }
}
