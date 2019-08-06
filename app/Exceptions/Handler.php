<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @param \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {


        if($exception instanceof NotFoundHttpException  && $request->wantsJson()){
            $json = [
                'message' => "404 - Incorrect url",
                'errors' => 'There is no such link.',
                "status"=>0,
            ];

            return response()->json($json, 404);
        }

        if($exception instanceof AuthenticationException  && $request->wantsJson() ){
            $json = [
                'message' => "You cannot sign with those credentials",
                'errors' => "Unauthenticated",
                "status"=>0,
            ];

            return response()->json($json, 401);
        }



        if($exception instanceof ValidationException  && $request->wantsJson() ){
            $json = [
                'message' => $exception->getMessage(),
                'errors' =>
                    $exception->errors()
                ,
                "status"=>0,
            ];

            return response()->json($json, 215);
        }




        if ($request->wantsJson() && !is_null($exception)) {

            $json = [
                'message' => "Something is going wrong!",
                'errors' => [
                    $exception->getMessage()
                ],
                'status' => 0
            ];

            return response()->json($json, 215);
        }


        return parent::render($request, $exception);
    }
}
