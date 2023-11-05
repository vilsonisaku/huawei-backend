<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

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
        });
    }

    public function render($request, Throwable $exception)
    {

        if ($exception instanceof ModelNotFoundException) {
            $message = explode("[",$exception->getMessage());
            $second = explode("\\",$message[1]);
            $name = array_pop($second);
            $message = $message[0] . str_replace("]"," with id",$name);
            return response()->json(["error"=>$message], 404);
        }

        if ($exception instanceof RouteNotFoundException) {
            return response()->json(["error"=>"You need to login to use this api"], 401);
        }
        

        return parent::render($request, $exception);
    }

}
